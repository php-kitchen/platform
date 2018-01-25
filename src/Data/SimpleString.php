<?php

namespace PHPKitchen\Platform\Data;

use PHPKitchen\Platform\Contract\Data\ValueObject;

/**
 * Represents
 *
 * @package PHPKitchen\Platform\Data
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class SimpleString implements ValueObject {
    protected $data;

    public function __construct(string $data = '') {
        $this->data = $data;
    }

    public static function from(string $data) {
        return new static($data);
    }

    ///region ----------------- VALUE OBJECT METHODS -----------------

    public function isEmpty(): bool {
        return empty($this->data);
    }

    public function isNull(): bool {
        return $this->data === null;
    }
    ///endregion
}