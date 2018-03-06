<?php

namespace PHPKitchen\Platform\Exception\Data;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception thrown if a length is invalid.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class LengthException extends \LengthException {
    use StaticConstructors;
}