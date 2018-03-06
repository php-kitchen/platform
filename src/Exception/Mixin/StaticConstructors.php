<?php

namespace PHPKitchen\Platform\Exception\Mixin;

/**
 * Represent static constructors for exceptions.
 *
 * @property string $message exception message.
 * @property int $code exception code.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
trait StaticConstructors {
    public static function withMessage(string $message): self {
        $exception = new static();
        $exception->message = $message;

        return $exception;
    }

    public static function withCode(int $code): self {
        $exception = new static();
        $exception->code = $code;

        return $exception;
    }

    public function andMessage(string $message): self {
        $this->message = $message;

        return $this;
    }

    public function andCode(int $code): self {
        $this->code = $code;

        return $this;
    }
}