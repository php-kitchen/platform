<?php

namespace PHPKitchen\SPL\Exception\Runtime\Method;

/**
 * Represents exception caused by calling a method in a wrong way.
 *
 * @package PHPKitchen\SPL\Exception\Runtime\Method
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class InvalidCallException {
    public function getName() {
        return 'Invalid Call';
    }
}