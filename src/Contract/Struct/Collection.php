<?php

namespace PHPKitchen\Platform\Contract\Struct;

/**
 * Represents a collection of mixed values without restriction
 * to keys.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
interface Collection extends StructureOfElements, IterableStructure, KeyBasedStructure {
    /**
     * Named constructor.
     *
     * @param array|iterable $elements elements of collection.
     *
     * @return Collection new collection of specified elements.
     *
     * @since 1.0
     */
    public static function of($elements): self;

    /**
     * Add element to the end of the collection.
     *
     * @param mixed $element element to add.
     *
     * @since 1.0
     */
    public function add($element): void;

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
    public function push(...$elements): int;

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
    public function pad(int $size, $value = null): void;

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
    public function chunkBy(int $size): self;

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
    public function chunkKeepingKeysBy(int $size): self;

    /**
     * Counts all the values of collection.
     *
     * @return Collection an associative collection of values from the collection as
     * keys and their count as value.
     *
     * @since 1.0
     */
    public function countValuesFrequency(): self;

    /**
     * Counts all the values of collection ignoring string values case.
     *
     * @return Collection an associative collection of values from the collection as
     * keys and their count as value.
     *
     * @since 1.0
     */
    public function countValuesFrequencyIgnoringCase(): self;

    /**
     * Calculate the product of values in collection.
     *
     * @return int|float the product as an integer or float.
     *
     * @since 1.0
     */
    public function calculateProduct();
}