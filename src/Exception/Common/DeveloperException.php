<?php

namespace PHPKitchen\Platform\Exception\Common;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception thrown because of action of a developer.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class DeveloperException extends \Exception {
    use StaticConstructors;

    public function getName() {
        return 'Developer Mistake';
    }
}