<?php

namespace PHPKitchen\Platform\Exception\Runtime\Method;

/**
 * Represents exception caused by calling a method in a wrong way.
 *
 * @package PHPKitchen\Platform\Exception\Runtime\Method
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class InvalidCallException extends \Exception {
    public function getName() {
        return 'Invalid Call';
    }
}