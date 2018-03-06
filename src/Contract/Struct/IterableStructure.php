<?php

namespace PHPKitchen\Platform\Contract\Struct;

/**
 * Represents iterable structure.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
interface IterableStructure {
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
    public function onEach(callable $do): bool;

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
    public function onEachRecursive(callable $do): bool;

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
    public function filter(callable $by);

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
    public function map(callable $by);

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
     *
     * @return mixed the resulting value.
     *
     * @since 1.0
     */
    public function reduce(callable $by, $withInitial = null);
}