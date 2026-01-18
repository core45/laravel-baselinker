<?php declare(strict_types=1);

namespace Core45\LaravelBaselinker\Exceptions;

use Exception;

class BaselinkerException extends Exception
{
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
    public static function apiError(string $message, int $errorCode = 0): self
    {
        return new self(
            "Baselinker API error: {$message}",
            $errorCode
        );
    }
}
