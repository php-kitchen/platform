<?php

namespace PHPKitchen\Platform\Exception\Common;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class UserException extends \Exception {
    use StaticConstructors;

    public function getName() {
        return 'User Mistake';
    }
}