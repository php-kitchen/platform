<?php

namespace PHPKitchen\Platform\Struct;

use PHPKitchen\Platform\Contract;
use PHPKitchen\Platform\Exception\Runtime\Method\InvalidArgumentException;
use PHPKitchen\Platform\Mixin\Properties;

/**
 * Represents implementation of array-based map.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class Map implements Contract\Struct\Map, Contract\Data\ValueObject {
    use Mixin\StructureOfElementsMethods;
    use Mixin\CountableMethods;
    use Mixin\IteratorMethods;
    use Mixin\JsonSerializableMethods;
    use Properties;
    protected const INVALID_KEY_ERROR_MESSAGE = 'Map support only `string` keys.';

    public function __construct($elements = []) {
        foreach ($elements as $key => $item) {
            if (is_numeric($key) || !is_string($key)) {
                throw InvalidArgumentException::withMessage(self::INVALID_KEY_ERROR_MESSAGE);
            }
        }
        $this->elements = $elements;
    }

    /**
     * Named constructor.
     *
     * @param array|iterable $elements elements of collection.
     *
     * @return Map new map of specified elements.
     *
     * @since 1.0
     */
    public static function of($elements): Contract\Struct\Map {
        return new static($elements);
    }

    public function add(string $key, $element): void {
        $this->elements[$key] = $element;
    }

    public function get(string $key) {
        return $this->hasKey($key) ? $this->elements[$key] : null;
    }

    public function keysToLowerCase(): void {
        $this->elements = array_change_key_case($this->elements, CASE_LOWER);
    }

    public function keysToUpperCase(): void {
        $this->elements = array_change_key_case($this->elements, CASE_UPPER);
    }

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
    public function chunkBy(int $size): Contract\Struct\Collection {
        $chunks = array_chunk($this->elements, $size, $keepKeys = true);
        $collections = Collection::of([]);
        foreach ($chunks as $chunk) {
            $collections->add(static::of($chunk));
        }

        return $collections;
    }

    public function getKeys(): Contract\Struct\Collection {
        return Collection::of(array_keys($this->elements));
    }

    public function getValues(): Contract\Struct\Collection {
        return Collection::of(array_values($this->elements));
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
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     *
     * @return mixed Can return all value types.
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
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     *
     * @return void
     * @since 1.0
     */
    public function offsetSet($offset, $value) {
        if (!is_string($offset)) {
            throw InvalidArgumentException::withMessage(self::INVALID_KEY_ERROR_MESSAGE);
        }
        $this->elements[$offset] = $value;
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
     * @since 1.0
     */
    public function offsetUnset($offset) {
        unset($this->elements[$offset]);
    }
    /// endregion
}