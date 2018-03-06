<?php

namespace PHPKitchen\Platform\Exception\CLI;

use PHPKitchen\Platform\Exception\Common\UserException;
use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class UnknownCommandException extends UserException {
    use StaticConstructors;

    public function getName() {
        return 'Unknown Command';
    }
}