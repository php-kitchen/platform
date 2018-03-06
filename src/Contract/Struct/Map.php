<?php

namespace PHPKitchen\Platform\Contract\Struct;

/**
 * Represents a collection of mixed elements with a strict restriction to
 * a key type - keys should be only strings.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
interface Map extends StructureOfElements, IterableStructure, KeyBasedStructure {
    /**
     * Named constructor.
     *
     * @param array|iterable $elements elements of collection.
     *
     * @return Map new map of specified elements.
     *
     * @since 1.0
     */
    public static function of($elements): self;

    public function add(string $key, $element): void;

    public function keysToLowerCase(): void;

    public function keysToUpperCase(): void;

    /**
     * Split collection into chunks of specified size.
     *
     * @param int $size size of each chunk.
     *
     * @return Collection a multidimensional numerically indexed collection, starting with zero,
     * with each dimension containing Map of specified size.
     *
     * @since 1.0
     */
    public function chunkBy(int $size): Collection;

    /**
     * Counts all the values of collection.
     *
     * @return Collection an associative collection of values from the collection as
     * keys and their count as value.
     *
     * @since 1.0
     */
    public function countValuesFrequency(): Collection;

    /**
     * Counts all the values of collection ignoring string values case.
     *
     * @return Collection an associative collection of values from the collection as
     * keys and their count as value.
     *
     * @since 1.0
     */
    public function countValuesFrequencyIgnoringCase(): Collection;

    /**
     * Calculate the product of values in collection.
     *
     * @return int|float the product as an integer or float.
     *
     * @since 1.0
     */
    public function calculateProduct();
}