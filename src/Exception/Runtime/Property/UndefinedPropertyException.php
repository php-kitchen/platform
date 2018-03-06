<?php

namespace PHPKitchen\Platform\Exception\Runtime\Property;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception caused by accessing unknown object properties.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class UndefinedPropertyException extends \RuntimeException {
    use StaticConstructors;
}