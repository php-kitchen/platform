<?php

namespace PHPKitchen\Platform\Contract\Struct;


use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * Represents basic structure of elements.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
interface StructureOfElements extends ArrayAccess, Countable, IteratorAggregate, JsonSerializable {
    /**
     * Clear all data from the collection.
     *
     * @since 1.0
     */
    public function clear(): void;

    public function has($element): bool;

    /**
     * Return last element of the collection and remove the element from the
     * collection.
     *
     * @return mixed first element of the collection
     *
     * @since 1.0
     */
    public function pop();

    /**
     * Return first element of the collection and remove the element from the
     * collection.
     *
     * @return mixed first element of the collection
     *
     * @since 1.0
     */
    public function shift();

    /**
     * Remove first occurrence of a specified element from the collection.
     *
     * @param mixed $element element to be removed.
     *
     * @since 1.0
     */
    public function remove($element): void;

    /**
     * Remove all occurrences of a specified element from the collection.
     *
     * @param mixed $element element to be removed.
     *
     * @since 1.0
     */
    public function removeAll($element): void;
}