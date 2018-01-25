<?php

namespace PHPKitchen\Platform\Contract\Collection;

use PHPKitchen\Platform\Contract\Data\ValueObject;

/**
 * Represents a collection of mixed values without restriction
 * to keys.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
interface Collection extends Base\ArrayBasedCollection, ValueObject {
    public function add($element);

    public function chunkKeepingKeysBy(int $size);

    public function pushToTheEnd(...$elements): bool;
}