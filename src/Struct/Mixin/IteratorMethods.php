<?php

namespace PHPKitchen\Platform\Struct\Mixin;

use ArrayIterator;

/**
 * Represents implementation of  iterator interface for collections.
 *
 * @property array $elements data storage.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
trait IteratorMethods {
    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     * 
     * @since 1.0
     */
    public function getIterator() {
        return new ArrayIterator($this->elements);
    }
}