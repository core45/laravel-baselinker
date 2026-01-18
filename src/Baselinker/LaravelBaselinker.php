<?php

declare(strict_types=1);

namespace Core45\LaravelBaselinker\Baselinker;

use Core45\LaravelBaselinker\Exceptions\BaselinkerException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use JsonException;

class LaravelBaselinker
{
    private bool $debug;

    private bool $verify;

    private string $url = 'https://api.baselinker.com/connector.php';

    private string $token;

    private const MAX_RETRIES = 3;

    private const RETRY_DELAYS = [1000, 2000, 4000]; // milliseconds

    /**
     * @throws BaselinkerException
     */
    public function __construct()
    {
        $token = config('baselinker.token');
        if (empty($token)) {
            $token = config('laravel-baselinker.token');
        }

        if (empty($token)) {
            throw BaselinkerException::missingToken();
        }

        $this->token = $token;
        $this->debug = config('baselinker.debug') ?? config('laravel-baselinker.debug', false);
        $this->verify = config('baselinker.verify') ?? config('laravel-baselinker.verify', true);
    }

    /**
     * Make a request to the Baselinker API with retry logic.
     *
     * @param  array<string, mixed>  $parameters
     * @return array<string, mixed>
     *
     * @throws BaselinkerException
     * @throws RequestException
     * @throws JsonException
     */
    protected function makeRequest(array $parameters): array
    {
        // Filter null values from nested parameters JSON
        if (isset($parameters['parameters'])) {
            $decoded = json_decode($parameters['parameters'], true, 512, JSON_THROW_ON_ERROR);
            $parameters['parameters'] = json_encode(
                $this->filterNullValues($decoded),
                JSON_THROW_ON_ERROR
            );
        }

        $this->logRequest($parameters);

        $lastException = null;

        for ($attempt = 0; $attempt <= self::MAX_RETRIES; $attempt++) {
            if ($attempt > 0) {
                $delay = self::RETRY_DELAYS[$attempt - 1] ?? self::RETRY_DELAYS[array_key_last(self::RETRY_DELAYS)];
                $this->logRetry($attempt, $delay);
                usleep($delay * 1000);
            }

            try {
                $response = Http::withOptions([
                    'verify' => $this->verify,
                ])->withHeaders([
                    'X-BLToken' => $this->token,
                ])->asForm()->post($this->url, $parameters);

                $response->throw();

                $data = $response->json();

                $this->logResponse($data);

                if (isset($data['status']) && $data['status'] === 'ERROR') {
                    $exception = BaselinkerException::apiError(
                        $data['error_message'] ?? 'Unknown API error',
                        $data['error_code'] ?? 0
                    );

                    // Don't retry on non-transient errors
                    if (! $exception->isRetryable()) {
                        throw $exception;
                    }

                    $lastException = $exception;

                    continue;
                }

                return $data;
            } catch (RequestException $e) {
                $lastException = $e;
                $this->logError($e, $attempt);

                // Only retry on server errors (5xx) or connection issues
                if ($e->response && $e->response->status() < 500) {
                    throw $e;
                }
            }
        }

        if ($lastException instanceof BaselinkerException) {
            throw $lastException;
        }

        throw $lastException ?? BaselinkerException::apiError('Request failed after retries', 0);
    }

    /**
     * Recursively filter null values from an array.
     *
     * @param  array<string, mixed>  $array
     * @return array<string, mixed>
     */
    private function filterNullValues(array $array): array
    {
        return array_filter($array, fn ($value) => $value !== null);
    }

    /**
     * Log the outgoing request when debug mode is enabled.
     *
     * @param  array<string, mixed>  $parameters
     */
    private function logRequest(array $parameters): void
    {
        if (! $this->debug) {
            return;
        }

        $method = $parameters['method'] ?? 'unknown';
        $logParams = $parameters;

        // Mask token in logs
        unset($logParams['token']);

        Log::debug('Baselinker API Request', [
            'method' => $method,
            'parameters' => $logParams,
        ]);
    }

    /**
     * Log the API response when debug mode is enabled.
     *
     * @param  array<string, mixed>|null  $data
     */
    private function logResponse(?array $data): void
    {
        if (! $this->debug) {
            return;
        }

        Log::debug('Baselinker API Response', [
            'status' => $data['status'] ?? 'unknown',
            'data' => $data,
        ]);
    }

    /**
     * Log retry attempts when debug mode is enabled.
     */
    private function logRetry(int $attempt, int $delayMs): void
    {
        if (! $this->debug) {
            return;
        }

        Log::debug('Baselinker API Retry', [
            'attempt' => $attempt,
            'delay_ms' => $delayMs,
        ]);
    }

    /**
     * Log errors when debug mode is enabled.
     */
    private function logError(\Throwable $e, int $attempt): void
    {
        if (! $this->debug) {
            return;
        }

        Log::warning('Baselinker API Error', [
            'attempt' => $attempt,
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
        ]);
    }
}
