<?php

namespace PHPKitchen\Platform\Struct\Mixin;

/**
 * Represents implementation of countable interface for collections.
 *
 * @property array $elements data storage.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
trait CountableMethods {
    /**
     * Count elements of an object
     *
     * @link http://php.net/manual/en/countable.count.php
     * @return int count of elements.
     *
     * @since 1.0
     */
    public function count() {
        return count($this->elements);
    }
}