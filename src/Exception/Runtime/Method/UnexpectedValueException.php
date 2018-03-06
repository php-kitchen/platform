<?php

namespace PHPKitchen\Platform\Exception\Runtime\Method;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception thrown if a value does not match with a set of values. Typically
 * this happens when a function calls another function and expects the return
 * value to be of a certain type or value not including arithmetic or buffer
 * related errors.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class UnexpectedValueException extends \UnexpectedValueException {
    use StaticConstructors;
}