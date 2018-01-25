<?php

namespace PHPKitchen\Platform\Collection\Mixin;

/**
 * Represents implementation of countable interface for collections.
 *
 * @property array $data  data storage.
 *
 * @package Collection\Mixin
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
trait CountableMethods {
    /**
     * Count elements of an object
     *
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count() {
        return count($this->data);
    }
}