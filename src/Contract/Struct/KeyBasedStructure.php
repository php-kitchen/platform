<?php

namespace PHPKitchen\Platform\Contract\Struct;

use PHPKitchen\Platform\Contract;

/**
 * Represents key-based structure of elements.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
interface KeyBasedStructure {
    public function hasKey($key): bool;

    public function hasSet($key): bool;

    /**
     * Remove element at specified index.
     *
     * @param int|string $key element index.
     *
     * @since 1.0
     */
    public function removeAt($key): void;

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
    public function keyOf($element, bool $strictTypeCheck = true);

    /**
     * Searches the collection for a given value and returns the last corresponding key if successful.
     *
     * @param mixed $element value to look for at the collection.
     * @param bool $strictTypeCheck determines if strict comparison (===) should be used during the search.
     *
     * @return false|int|string key of an element or `false` if element not found.
     * @since 1.0
     */
    public function lastKeyOf($element, bool $strictTypeCheck = true);

    /**
     * Searches the collection for a given value and returns the corresponding keys if successful.
     *
     * @param mixed $element value to look for at the collection.
     * @param bool $strictTypeCheck determines if strict comparison (===) should be used during the search.
     *
     * @return Contract\Struct\Collection collection of keys given element obtain.
     */
    public function allKeysOf($element, bool $strictTypeCheck = true): Contract\Struct\Collection;

    /**
     * Gets keys of the collection.
     *
     * @return Collection collection of the collection keys.
     */
    public function getKeys(): Contract\Struct\Collection;

    /**
     * Gets values of the collection.
     *
     * @return Collection collection of the collection keys.
     */
    public function getValues(): Contract\Struct\Collection;
}