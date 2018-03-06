<?php

namespace PHPKitchen\Platform\Exception\Runtime\Method;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception thrown if an argument is not of the expected type.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class InvalidArgumentException extends \InvalidArgumentException {
    use StaticConstructors;
}