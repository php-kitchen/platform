<?php

namespace PHPKitchen\Platform\Data;

use PHPKitchen\Platform\Contract\Data\ValueObject;

/**
 * Represents basic null object.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class NullObject implements ValueObject {
    public function isEmpty(): bool {
        return true;
    }

    public function isNull(): bool {
        return true;
    }
}