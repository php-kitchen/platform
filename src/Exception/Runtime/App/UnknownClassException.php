<?php

namespace PHPKitchen\SPL\Exception\Runtime\App;

/**
 * Represents  an exception caused by using an unknown class.
 *
 * @package PHPKitchen\SPL\Exception\Runtime\App
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class UnknownClassException extends \RuntimeException {
    public function getName() {
        return 'Unknown Class';
    }
}