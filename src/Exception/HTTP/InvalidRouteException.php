<?php

namespace PHPKitchen\SPL\Exception\HTTP;

/**
 * Represents exception caused by an invalid route.
 *
 * @package PHPKitchen\SPL\Exception\HTTP
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class InvalidRouteException {
    public function getName() {
        return 'Invalid Route';
    }
}