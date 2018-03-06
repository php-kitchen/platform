<?php

namespace PHPKitchen\Platform\Exception\Runtime\App;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents  an exception caused by using an unknown class.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class UnknownClassException extends \RuntimeException {
    use StaticConstructors;

    public function getName() {
        return 'Unknown Class';
    }
}