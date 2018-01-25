<?php

namespace PHPKitchen\Platform\Collection\Mixin;

use JsonSerializable;

/**
 * Represents realization of JSON serialization method for collection.
 *
 * @property array $data data storage.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
trait  JsonSerializableMethods {
    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize() {
        return array_map(function ($value) {
            if ($value instanceof JsonSerializable) {
                return $value->jsonSerialize();
            }

            return $value;
        }, $this->data);
    }
}