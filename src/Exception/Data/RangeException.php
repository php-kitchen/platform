<?php

namespace PHPKitchen\Platform\Exception\Data;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception thrown to indicate range errors during program execution. Normally this means there was an arithmetic error other than under/overflow.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class RangeException extends \RangeException {
    use StaticConstructors;
}