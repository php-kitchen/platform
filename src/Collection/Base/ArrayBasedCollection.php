<?php

namespace PHPKitchen\Platform\Collection\Base;

use PHPKitchen\Platform\Collection\Mixin;
use PHPKitchen\Platform\Contract;

/**
 * Represents a base class for collections based on arrays.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
abstract class ArrayBasedCollection {
    use Mixin\CountableMethods;
    use Mixin\IteratorMethods;
    use Mixin\JsonSerializableMethods;
    protected $data;

    public function __construct($data = []) {
        $this->data = $data;
    }

    public static function from($data) {
        return new static($data);
    }

    ///region ----------------- DATA CLEANING METHODS -----------------

    public function clear(): void {
        $this->data = [];
    }

    public function remove($element): void {
        if (($index = $this->keyOf($element)) !== false) {
            $this->removeAt($index);
        }
    }

    public function removeAll($element): void {
        $indexes = $this->allKeysOf($element);
        foreach ($indexes as $index) {
            $this->removeAt($index);
        }
    }

    public function removeAt($index): void {
        unset($this->data[$index]);
    }

    ///endregion
    ///
    ////region ----------------- DATA MANIPULATION BY CALLABLE METHODS -----------------

    public function onEach(callable $do): bool {
        return array_walk($this->data, $do);
    }

    public function onEachRecursive(callable $do): bool {
        return array_walk_recursive($this->data, $do);
    }

    public function filter(callable $by): void {
        $this->data = array_filter($this->data, $by);
    }

    public function map(callable $by): void {
        $this->data = array_map($this->data, $by);
    }

    public function reduce(callable $by): void {
        $this->data = array_reduce($this->data, $by);
    }

    ///endregion
    ///
    ///region ----------------- DATA CHECK METHODS -----------------

    public function hasKey($key): bool {
        return array_key_exists($key, $this->data);
    }

    public function has($element): bool {
        return in_array($element, $this->data);
    }

    public function hasSet($key): bool {
        return $this->hasKey($key) && !empty($this->data[$key]);
    }

    ///endregion
    ///
    ///region ----------------- DATA RETRIEVE METHODS -----------------

    public function keyOf($element) {
        // stub
        return array_search($this->data, $element, true);
    }

    public function lastKeyOf($element) {
        $indexes = array_keys($this->data, $element, true);

        return !empty($indexes) ? end($indexes) : false;
    }

    public function allKeysOf($element): self {
        return static::from(array_keys($this->data, $element, true));
    }

    public function getKeys(): self {
        return static::from(array_keys($this->data));
    }

    public function getValues(): self {
        return static::from(array_values($this->data));
    }

    public function countValues(): self {
        return static::from(array_count_values($this->data));
    }

    public function calculateAverage() {
        return array_product($this->data);
    }

    ///endregion
    ///
    ///region ----------------- DATA MANIPULATION METHODS -----------------

    public function multiSort(): bool {
        // @todo support of collection
        return array_multisort($this->data);
    }

    public function popFromEnd() {
        return array_pop($this->data);
    }

    public function shiftFromStart() {
        return array_shift($this->data);
    }

    ///endregion
    ///
    ///region ----------------- VALUE OBJECT METHODS -----------------

    public function isEmpty(): bool {
        return empty($this->data);
    }

    public function isNull(): bool {
        return $this->data === null;
    }
    ///endregion
}