<?php

namespace PHPKitchen\Platform\Exception\HTTP;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception caused by an invalid route.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class InternalServerException extends \Exception {
    use StaticConstructors;

    public function __construct(string $message = "", int $code = 500, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function getName() {
        return 'Resource Not Found';
    }
}