<?php

namespace PHPKitchen\Platform\Data;

use PHPKitchen\Platform\Contract\Data\ValueObject;

/**
 * Represents basic null object.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class NullObject implements ValueObject {
    public function isEmpty(): bool {
        return true;
    }

    public function isNull(): bool {
        return true;
    }

    public function isEqualTo($value): bool {
        if (null === $value) {
            return true;
        } elseif ($value instanceof NullObject) {
            return true;
        } else {
            return false;
        }
    }
}