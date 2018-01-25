<?php

namespace PHPKitchen\Platform\Contract\Collection;

use PHPKitchen\Platform\Contract\Data\ValueObject;

/**
 * Represents a collection of mixed elements with a strict restriction to
 * a key type - keys should be only strings.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
interface Map extends Base\ArrayBasedCollection, ValueObject {
    public function add(string $key, $element);

    public function get(string $key);

    public function keysToLowerCase(): void;

    public function keysToUpperCase(): void;
}