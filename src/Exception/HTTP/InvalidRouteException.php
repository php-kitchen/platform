<?php

namespace PHPKitchen\Platform\Exception\HTTP;

use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception caused by an invalid route.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class InvalidRouteException extends \Exception {
    use StaticConstructors;

    public function getName() {
        return 'Invalid Route';
    }
}