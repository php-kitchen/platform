<?php

namespace PHPKitchen\Platform\Exception\Runtime\Method;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception thrown if a callback refers to an undefined method.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class UndefinedMethodException extends \BadMethodCallException {
    use StaticConstructors;
}