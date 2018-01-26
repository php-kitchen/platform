<?php

namespace PHPKitchen\Platform\Exception\CLI;

use PHPKitchen\Platform\Exception\Common\UserException;

/**
 * Represents
 *
 * @package PHPKitchen\Platform\Exception\CLI
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class UnknownCommandException extends UserException {
    public function getName() {
        return 'Unknown Command';
    }
}