<?php

namespace PHPKitchen\Platform\Exception\Runtime\Method;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception caused by calling a method in a wrong way.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class InvalidCallException extends \BadMethodCallException {
    use StaticConstructors;

    public function getName() {
        return 'Invalid Call';
    }
}