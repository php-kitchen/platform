<?php

namespace PHPKitchen\SPL\Exception\CLI;

use PHPKitchen\SPL\Exception\Common\UserException;

/**
 * Represents
 *
 * @package PHPKitchen\SPL\Exception\CLI
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class UnknownCommandException extends UserException {
    public function getName() {
        return 'Unknown Command';
    }
}