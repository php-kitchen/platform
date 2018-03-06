<?php

namespace PHPKitchen\Platform\Exception\Runtime\Property;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception caused by accessing object properties in a wrong way.
 *
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class InvalidAccessException extends \RuntimeException {
    use StaticConstructors;
}