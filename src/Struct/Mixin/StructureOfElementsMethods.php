<?php

namespace PHPKitchen\Platform\Struct\Mixin;

use PHPKitchen\Platform\Struct\Collection;
use PHPKitchen\Platform\Contract;

/**
 * Represents implementation of collections methods based on arrays.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
trait StructureOfElementsMethods {
    /**
     * @var array collection items storage.
     */
    protected $elements;

    ///region ----------------- DATA CLEANING METHODS -----------------

    /**
     * Clear all data from the collection.
     *
     * @since 1.0
     */
    public function clear(): void {
        $this->elements = [];
    }

    /**
     * Remove first occurrence of a specified element from the collection.
     *
     * @param mixed $element element to be removed.
     *
     * @since 1.0
     */
    public function remove($element): void {
        if (($index = $this->keyOf($element)) !== false) {
            $this->removeAt($index);
        }
    }

    /**
     * Remove all occurrences of a specified element from the collection.
     *
     * @param mixed $element element to be removed.
     *
     * @since 1.0
     */
    public function removeAll($element): void {
        $indexes = $this->allKeysOf($element);
        foreach ($indexes as $index) {
            $this->removeAt($index);
        }
    }

    /**
     * Remove element at specified index.
     *
     * @param int|string $key element index.
     *
     * @since 1.0
     */
    public function removeAt($key): void {
        unset($this->elements[$key]);
    }

    ///endregion
    ///
    ////region ----------------- DATA MANIPULATION BY CALLABLE METHODS -----------------

    /**
     * Apply a user function to every element of the collection.
     *
     * @param callable $do callable that takes on two parameters.
     * The input parameter's value being the first, and  the key/index second.
     * Example:
     * <code>
     * $collection->onEach(function ($element, $key) {
     *     $element++; // won't change original collection
     * });
     * </code>
     *
     * If callable needs to be working with the actual values of the collection,
     * specify the first parameter of callable as a reference. Then, any changes made
     * to those elements will be made in the original collection itself.
     * Example:
     * <code>
     * $collection = Collection::of([1, 2, 3]);
     * $collection->onEach(function (&$element, $key) {
     *     $element++;
     * });
     * // $collection is equal to Collection::of([2, 3, 4]);
     * </code>
     *
     * @return bool true on success or false on failure.
     *
     * @see onEachRecursive to run callbale on each element recursively.
     * @since 1.0
     */
    public function onEach(callable $do): bool {
        return array_walk($this->elements, $do);
    }

    /**
     * Apply a user function recursively to every element of the collection.
     *
     * @param callable $do callable that takes on two parameters.
     * The input parameter's value being the first, and  the key/index second.
     * Example:
     * <code>
     * $collection->onEach(function ($element, $key) {
     *     $element++; // won't change original collection
     * });
     * </code>
     *
     * If callable needs to be working with the actual values of the collection,
     * specify the first parameter of callable as a reference. Then, any changes made
     * to those elements will be made in the original collection itself.
     * Example:
     * <code>
     * $collection = Collection::of([1, 2, 3]);
     * $collection->onEachRecursive(function (&$element) {
     *     $element++;
     * });
     * // $collection is equal to Collection::of([2, 3, 4]);
     * </code>
     *
     * @return bool true on success or false on failure.
     *
     * @since 1.0
     */
    public function onEachRecursive(callable $do): bool {
        return array_walk_recursive($this->elements, $do);
    }

    /**
     * Iterates over each value in the collection passing them to the callback function.
     * If the callback function returns `true`, the current value passed to the new collection,
     * if `false` value will won't be added to the new collection.
     * Note: keys are preserved.
     *
     * Example:
     * <code>
     * $collection = Collection::of([1, 2, 3, 3]);
     * // remove from the collection all elements equal to 3
     * $filteredCollection = $collection->filter(function ($element) {
     *    if ($element == 3) {
     *        return false;
     *    };
     *    return true;
     * });
     * // $filteredCollection is equal to Collection::of([1, 2]);
     * </code>
     *
     * @param callable $by user function that take collection element as
     * and input parameter.
     *
     * @return static new collection containing all the elements of original collection
     * after applying the callback function to each element.
     *
     * @since 1.0
     */
    public function filter(callable $by): self {
        return static::of(array_filter($this->elements, $by));
    }

    /**
     * Applies the callback to the elements of the collection.
     * The return value of a callback function
     * Example:
     * <code>
     * $collection = Collection::of([1, 2, 3]);
     * // remove from the collection all elements equal to 3
     * $mappedCollection = $collection->map(function ($element) {
     *    return $element * $element;
     * });
     * // $mappedCollection is equal to Collection::of([1, 4, 9]);
     * </code>
     *
     * @param callable $by callback function to run for each element.
     *
     * @return static new collection containing all the elements of original collection
     * after applying the callback function to each element.
     *
     * @since 1.0
     */
    public function map(callable $by): self {
        return static::of(array_map($by, $this->elements));
    }

    /**
     * Iteratively reduce the collection to a single value using a callback function
     *
     * Example:
     * <code>
     * $collection = Collection::of([1, 2, 3]);
     * // remove from the collection all elements equal to 3
     * $reducedCollectionValue = $collection->reduce(function ($result, $element) {
     *    $result += $element;
     *
     *    return $result;
     * });
     * // reducedCollectionValue is equal to `6`
     * </code>
     *
     * @param callback $by the callback function.
     * @param mixed $withInitial [optional] if the optional initial is available, it will
     * be used at the beginning of the process, or as a final result in case
     * the collection is empty.
     * </p
     * @return mixed the resulting value.
     * @since 1.0
     */
    public function reduce(callable $by, $withInitial = null) {
        return array_reduce($this->elements, $by, $withInitial);
    }

    ///endregion
    ///
    ///region ----------------- DATA CHECK METHODS -----------------

    public function hasKey($key): bool {
        return array_key_exists($key, $this->elements);
    }

    public function has($element): bool {
        return in_array($element, $this->elements);
    }

    public function hasSet($key): bool {
        return isset($this->elements[$key]);
    }

    ///endregion
    ///
    ///region ----------------- DATA RETRIEVE METHODS -----------------

    /**
     * Searches the collection for a given value and returns the corresponding key if successful.
     *
     * If element is found  more than once, the first matching key is returned. To return the keys
     * for all matching values, use {@link allKeysOf}.
     *
     * @param mixed $element value to look for at the collection.
     * @param bool $strictTypeCheck determines if strict comparison (===) should be used during the search.
     *
     * @return false|int|string key of an element or `false` if element not found.
     * @since 1.0
     */
    public function keyOf($element, bool $strictTypeCheck = true) {
        // stub
        return array_search($element, $this->elements, $strictTypeCheck);
    }

    /**
     * Searches the collection for a given value and returns the last corresponding key if successful.
     *
     * @param mixed $element value to look for at the collection.
     * @param bool $strictTypeCheck determines if strict comparison (===) should be used during the search.
     *
     * @return false|int|string key of an element or `false` if element not found.
     * @since 1.0
     */
    public function lastKeyOf($element, bool $strictTypeCheck = true) {
        $indexes = array_keys($this->elements, $element, $strictTypeCheck);

        return !empty($indexes) ? end($indexes) : false;
    }

    /**
     * Searches the collection for a given value and returns the corresponding keys if successful.
     *
     * @param mixed $element value to look for at the collection.
     * @param bool $strictTypeCheck determines if strict comparison (===) should be used during the search.
     *
     * @return Contract\Struct\Collection collection of keys given element obtain.
     */
    public function allKeysOf($element, bool $strictTypeCheck = true): Contract\Struct\Collection {
        return Collection::of(array_keys($this->elements, $element, $strictTypeCheck));
    }

    /**
     * Counts all the values of collection.
     *
     * @return Collection an associative collection of values from the collection as
     * keys and their count as value.
     *
     * @since 1.0
     */
    public function countValuesFrequency(): Contract\Struct\Collection {
        return Collection::of(array_count_values($this->elements));
    }

    /**
     * Counts all the values of collection ignoring string values case.
     *
     * @return Collection an associative collection of values from the collection as
     * keys and their count as value.
     *
     * @since 1.0
     */
    public function countValuesFrequencyIgnoringCase(): Contract\Struct\Collection {
        return Collection::of(array_count_values(array_map('strtolower', $this->elements)));
    }

    /**
     * Calculate the product of values in collection.
     *
     * @return int|float the product as an integer or float.
     *
     * @since 1.0
     */
    public function calculateProduct() {
        return array_product($this->elements);
    }

    ///endregion
    ///
    ///region ----------------- DATA MANIPULATION METHODS -----------------
    /**
     * Return last element of the collection and remove the element from the
     * collection.
     *
     * @return mixed first element of the collection
     *
     * @since 1.0
     */
    public function pop() {
        return array_pop($this->elements);
    }

    /**
     * Return first element of the collection and remove the element from the
     * collection.
     *
     * @return mixed first element of the collection
     * @since 1.0
     */
    public function shift() {
        return array_shift($this->elements);
    }

    ///endregion
    ///
    ///region ----------------- VALUE OBJECT METHODS -----------------

    public function isEmpty(): bool {
        return empty($this->elements);
    }

    public function isNull(): bool {
        return $this->elements === null;
    }

    public function isEqualTo($value): bool {
        if (is_array($value) && $this->elements === $value) {
            return true;
        } elseif ($value instanceof Contract\Struct\Collection || $value instanceof Contract\Struct\Map) {
            /**
             * in case of collection, need to pass current collection elements to `isEqualTo` in order
             * to compare elements by the first rule above
             * @var Contract\Data\ValueObject $value
             */
            return $value->isEqualTo($this->elements);
        } else {
            return false;
        }
    }
    ///endregion
}