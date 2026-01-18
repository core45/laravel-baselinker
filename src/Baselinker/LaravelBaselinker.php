<?php

namespace Core45\LaravelBaselinker\Baselinker;

use Core45\LaravelBaselinker\Exceptions\BaselinkerException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class LaravelBaselinker
{
    private bool $debug;
    private bool $verify;
    private string $url = 'https://api.baselinker.com/connector.php';
    private string $token;

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
     * Make a request to the Baselinker API.
     *
     * @param array<string, mixed> $parameters
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    protected function makeRequest(array $parameters): Response
    {
        $response = Http::withOptions([
            'debug' => $this->debug,
            'verify' => $this->verify,
        ])->withHeaders([
            'X-BLToken' => $this->token,
        ])->asForm()->post($this->url, $parameters);

        // Throw exception for HTTP 4xx/5xx errors
        $response->throw();

        return $response;
    }
}
