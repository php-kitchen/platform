<?php

namespace PHPKitchen\Platform\Contract\Collection\Base;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * Represents a common interface of collections based on PHP arrays.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
interface ArrayBasedCollection extends ArrayAccess, Countable, IteratorAggregate, JsonSerializable {
    public static function from($data);

    ///region ----------------- DATA CLEANING METHODS -----------------

    public function clear(): void;

    public function remove($element): void;

    public function removeAll($element): void;

    public function removeAt($index): void;

    ////endregion
    ///
    ////region ----------------- DATA MANIPULATION BY CALLABLE METHODS -----------------

    public function onEach(callable $do): bool;

    public function onEachRecursive(callable $do): bool;

    public function filter(callable $by): void;

    public function map(callable $by): void;

    public function reduce(callable $by): void;

    ///endregion
    ///
    ///region ----------------- DATA CHECK METHODS -----------------

    public function hasKey($key): bool;

    public function has($element): bool;

    public function hasSet($key): bool;

    ///endregion
    ///
    ///region ----------------- DATA RETRIEVE METHODS -----------------

    public function keyOf($element);

    public function lastKeyOf($element);

    public function allKeysOf($element);

    public function getKeys();

    public function getValues();

    public function countValues();

    public function calculateAverage();

    ///endregion
    ///
    ///region ----------------- DATA MANIPULATION METHODS -----------------

    public function chunkBy(int $size);

    public function multiSort(): bool;
    ///endregion
}