<?php

namespace PHPKitchen\Platform\Struct;

use PHPKitchen\Platform\Contract;
use PHPKitchen\Platform\Mixin\Properties;

/**
 * Represents implementation of array based collection.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class Collection implements Contract\Struct\Collection, Contract\Data\ValueObject {
    use Mixin\StructureOfElementsMethods;
    use Mixin\CountableMethods;
    use Mixin\IteratorMethods;
    use Mixin\JsonSerializableMethods;
    use Properties;

    public function __construct($elements = []) {
        $this->elements = $elements;
    }

    /**
     * Named constructor.
     *
     * @param array|iterable $elements elements of collection.
     *
     * @return Collection new collection of specified elements.
     *
     * @since 1.0
     */
    public static function of($elements): Contract\Struct\Collection {
        return new static($elements);
    }

    /**
     * Add element to the end of the collection.
     *
     * @param mixed $element element to add.
     *
     * @since 1.0
     */
    public function add($element): void {
        $this->elements[] = $element;
    }

    /**
     * Push one or more elements onto the end of collection.
     * Example:
     * ```php
     * $collection->push(1, 2, 3, 4);
     * ```
     *
     * @param array ...$elements elements.
     *
     * @return int the new number of elements in the array.
     *
     * @since 1.0
     */
    public function push(...$elements): int {
        return array_push($this->elements, ...$elements);
    }

    /**
     * Pad collection to the specified length with a value.
     *
     * @param int $size new size of the collection. If size is
     * positive then the collection is padded on the right, if it's negative then
     * on the left. If the absolute value of size is less than or equal to
     * the length of the collection then no padding takes place.
     * @param mixed $value Value to pad if input is less than `size`.
     *
     * @since 1.0
     */
    public function pad(int $size, $value = null): void {
        $this->elements = array_pad($this->elements, $size, $value);
    }

    /**
     * Split collection into chunks of specified size.
     *
     * @param int $size size of each chunk.
     *
     * @return Collection a multidimensional numerically indexed collection, starting with zero,
     * with each dimension containing collection of specified size.
     *
     * @since 1.0
     */
    public function chunkBy(int $size): Contract\Struct\Collection {
        $chunks = array_chunk($this->elements, $size, $keepKeys = false);
        $collections = static::of([]);
        foreach ($chunks as $chunk) {
            $collections->add(static::of($chunk));
        }

        return $collections;
    }

    /**
     * Split collection into chunks of specified size keeping original indexes.
     *
     * @param int $size size of each chunk.
     *
     * @return Collection a multidimensional numerically indexed collection, starting with zero,
     * with each dimension containing collection of specified size and keys equal to original keys
     * of elements.
     *
     * @since 1.0
     */
    public function chunkKeepingKeysBy(int $size): Contract\Struct\Collection {
        $chunks = array_chunk($this->elements, $size, $keepKeys = true);
        $collections = static::of([]);
        foreach ($chunks as $chunk) {
            $collections->add(static::of($chunk));
        }

        return $collections;
    }

    /**
     * Gets keys of the collection.
     *
     * @return Collection collection of the collection keys.
     */
    public function getKeys(): Contract\Struct\Collection {
        return static::of(array_keys($this->elements));
    }

    /**
     * Gets values of the collection.
     *
     * @return Contract\Struct\Collection collection of the collection keys.
     */
    public function getValues(): Contract\Struct\Collection {
        return static::of(array_values($this->elements));
    }

    ///endregion
    ///
    /// region ----------------- ARRAY ACCESS METHODS -----------------

    /**
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset An offset to check for.
     *
     * @return boolean true on success or false on failure.
     * The return value will be casted to boolean if non-boolean was returned.
     *
     * @since 1.0
     */
    public function offsetExists($offset) {
        return $this->hasKey($offset);
    }

    /**
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset the offset to retrieve.
     *
     * @return mixed Can return all value types.
     *
     * @since 1.0
     */
    public function offsetGet($offset) {
        return $this->elements[$offset] ?? null;
    }

    /**
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value the value to set.
     *
     * @return void
     *
     * @since 1.0
     */
    public function offsetSet($offset, $value) {
        if ($offset === null) {
            $this->elements[] = $value;
        } else {
            $this->elements[$offset] = $value;
        }
    }

    /**
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset the offset to unset.
     *
     * @return void
     *
     * @since 1.0
     */
    public function offsetUnset($offset) {
        unset($this->elements[$offset]);
    }
    /// endregion
}