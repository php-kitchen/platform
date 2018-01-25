<?php

namespace PHPKitchen\SPL\Exception\Runtime\App;

use Throwable;

/**
 * Represents thrown to terminate application.
 *
 * Such exception should be caught only by low-level classes that would handle {@link statusCode} and
 * terminate the application.
 *
 * @package PHPKitchen\SPL\Exception\Runtime\App
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class ExitException extends \Exception {
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

    public function getName() {
        return 'App Exit';
    }
}