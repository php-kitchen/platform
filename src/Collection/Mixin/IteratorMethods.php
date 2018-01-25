<?php

namespace PHPKitchen\Platform\Collection\Mixin;

use ArrayIterator;

/**
 * Represents implementation of  iterator interface for collections.
 *
 * @property array $data data storage.
 *
 * @package Collection\Mixin
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
trait IteratorMethods {
    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator() {
        return new ArrayIterator($this->data);
    }
}