<?php

namespace PHPKitchen\Platform\Exception\HTTP;

/**
 * Represents exception caused by an invalid route.
 *
 * @package PHPKitchen\Platform\Exception\HTTP
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class InvalidRouteException {
    public function getName() {
        return 'Invalid Route';
    }
}