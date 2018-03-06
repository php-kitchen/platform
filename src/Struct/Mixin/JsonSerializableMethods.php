<?php

namespace PHPKitchen\Platform\Struct\Mixin;

use JsonSerializable;

/**
 * Represents realization of JSON serialization method for collection.
 *
 * @property array $elements data storage.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
trait JsonSerializableMethods {
    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     * @since 1.0
     */
    public function jsonSerialize() {
        return array_map(function ($value) {
            if ($value instanceof JsonSerializable) {
                return $value->jsonSerialize();
            }

            return $value;
        }, $this->elements);
    }
}