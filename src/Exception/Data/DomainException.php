<?php

namespace PHPKitchen\Platform\Exception\Data;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception thrown if a value does not adhere to a defined valid data domain.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class DomainException extends \DomainException {
    use StaticConstructors;
}