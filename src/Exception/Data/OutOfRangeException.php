<?php

namespace PHPKitchen\Platform\Exception\Data;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents Exception thrown when an illegal index was requested.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class OutOfRangeException extends \OutOfRangeException {
    use StaticConstructors;
}