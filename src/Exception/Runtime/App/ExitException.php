<?php

namespace PHPKitchen\Platform\Exception\Runtime\App;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;
use Throwable;

/**
 * Represents thrown to terminate application.
 *
 * Such exception should be caught only by low-level classes that would handle {@link statusCode} and
 * terminate the application.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class ExitException extends \Exception {
    use StaticConstructors;
    /**
     * @var int the exit status code
     */
    public $statusCode;

    /**
     * Constructor.
     *
     * @param int $status the exit status code
     * @param string $message error message
     * @param int $code error code
     * @param Throwable $previous The previous exception used for the exception chaining.
     */
    public function __construct($status = 0, $message = null, $code = 0, Throwable $previous = null) {
        $this->statusCode = $status;
        parent::__construct($message, $code, $previous);
    }

    public static function withStatusCode(int $code): self {
        $exception = new static($code);

        return $exception;
    }

    public function getName() {
        return 'App Exit';
    }

    public function andStatusCode(int $code): self {
        $this->statusCode = $code;

        return $this;
    }
}