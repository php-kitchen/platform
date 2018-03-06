<?php

namespace PHPKitchen\Platform\Contract\Data;

/**
 * Represents basic value object interface.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
interface ValueObject {
    public function isEmpty(): bool;

    public function isNull(): bool;

    public function isEqualTo($value): bool;
}