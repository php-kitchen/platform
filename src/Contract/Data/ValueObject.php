<?php

namespace PHPKitchen\Platform\Contract\Data;

/**
 * Represents basic value object interface.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
interface ValueObject {
    public function isEmpty(): bool;

    public function isNull(): bool;
}