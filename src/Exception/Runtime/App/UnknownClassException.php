<?php

namespace PHPKitchen\Platform\Exception\Runtime\App;

/**
 * Represents  an exception caused by using an unknown class.
 *
 * @package PHPKitchen\Platform\Exception\Runtime\App
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class UnknownClassException extends \RuntimeException {
    public function getName() {
        return 'Unknown Class';
    }
}