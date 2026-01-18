<?php

declare(strict_types=1);

namespace Core45\LaravelBaselinker\Exceptions;

use Exception;

class BaselinkerException extends Exception
{
    /**
     * Error codes that indicate transient failures (safe to retry).
     *
     * @var array<int>
     */
    private const RETRYABLE_ERROR_CODES = [
        429,  // Rate limit exceeded
        503,  // Service unavailable
        504,  // Gateway timeout
    ];

    private int $errorCode;

    public function __construct(string $message = '', int $errorCode = 0, ?\Throwable $previous = null)
    {
        $this->errorCode = $errorCode;
        parent::__construct($message, $errorCode, $previous);
    }

    /**
     * Create a new exception for missing configuration.
     */
    public static function missingToken(): self
    {
        return new self(
            'Baselinker API token is not configured. Please set BASELINKER_TOKEN in your .env file.'
        );
    }

    /**
     * Create a new exception for API errors.
     */
    public static function apiError(string $message, int|string $errorCode = 0): self
    {
        return new self(
            "Baselinker API error: {$message}",
            (int) $errorCode
        );
    }

    /**
     * Get the Baselinker API error code.
     *
     * Semantic alias for getCode() - makes intent clearer in consuming code.
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * Determine if this error is transient and safe to retry.
     *
     * Rate limits (429), service unavailable (503), and gateway timeouts (504)
     * are typically transient and may succeed on retry.
     */
    public function isRetryable(): bool
    {
        return in_array($this->errorCode, self::RETRYABLE_ERROR_CODES, true);
    }

    /**
     * Check if this is a rate limit error.
     */
    public function isRateLimitError(): bool
    {
        return $this->errorCode === 429;
    }
}
