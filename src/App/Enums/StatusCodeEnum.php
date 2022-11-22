<?php

namespace UserAuth\App\Enums;

enum StatusCodeEnum: int
{
    case OK = 200;
    case BAD_REQUEST = 400;
    case NOT_FOUND = 404;
    case UNPROCESSABLE_ENTITY = 422;

    public function getMessage(): string
    {
        return match ($this) {
            self::OK => 'OK',
            self::BAD_REQUEST => 'Bad Request',
            self::NOT_FOUND => 'Not Found',
            self::UNPROCESSABLE_ENTITY => 'Unavailable Entity',
        };
    }

    public function isSuccess(): bool
    {
        return match($this) {
            self::OK => true,
            default => false,
        };
    }
}
