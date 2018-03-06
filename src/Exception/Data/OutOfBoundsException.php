<?php

namespace PHPKitchen\Platform\Exception\Data;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception thrown if a value is not a valid key.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class OutOfBoundsException extends \OutOfBoundsException {
    use StaticConstructors;
}