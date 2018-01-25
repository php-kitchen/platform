<?php

namespace PHPKitchen\Platform\Collection;

use PHPKitchen\Platform\Contract;

/**
 * Represents implementation of array-based map.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class Map extends Base\ArrayBasedCollection implements Contract\Collection\Map {
    public function add(string $key, $element) {
        $this->data[$key] = $element;
    }

    public function get(string $key) {
        return $this->hasKey($key) ? $this->data[$key] : null;
    }

    public function keysToLowerCase(): void {
        $this->data = array_change_key_case($this->data, CASE_LOWER);
    }

    public function keysToUpperCase(): void {
        $this->data = array_change_key_case($this->data, CASE_UPPER);
    }

    public function chunkBy(int $size): self {
        $chunks = array_chunk($this->data, $size, $keepKeys = true);
        $collections = new static();
        foreach ($chunks as $chunk) {
            $collections[] = $chunk;
        }

        return $collections;
    }

    // region ----------------- ARRAY ACCESS METHODS -----------------

    /**
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset) {
        return $this->hasKey($this->data[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset) {
        return $this->data[$offset] ?? null;
    }

    /**
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value) {
        $this->data[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }
    /// endregion
}