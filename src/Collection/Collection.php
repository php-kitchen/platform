<?php

namespace PHPKitchen\Platform\Collection;

use PHPKitchen\Platform\Contract;

/**
 * Represents implementation of array based collection.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class Collection extends Base\ArrayBasedCollection implements Contract\Collection\Collection {
    ///region ----------------- DATA MANIPULATION METHODS -----------------

    public function add($element) {
        $this->data[] = $element;
    }

    public function pushToTheEnd(...$elements): bool {
        return array_push($this->data, ...$elements);
    }

    public function pad(int $size, $value): void {
        $this->data = array_pad($this->data, $size, $value);
    }

    public function chunkBy(int $size): self {
        $chunks = array_chunk($this->data, $size, $keepKeys = false);
        $collections = new static();
        foreach ($chunks as $chunk) {
            $collections[] = $chunk;
        }

        return $collections;
    }

    public function chunkKeepingKeysBy(int $size): self {
        $chunks = array_chunk($this->data, $size, $keepKeys = true);
        $collections = new static();
        foreach ($chunks as $chunk) {
            $collections[] = $chunk;
        }

        return $collections;
    }

    ///endregion
    ///
    /// region ----------------- ARRAY ACCESS METHODS -----------------

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
     */
    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }
    /// endregion
}