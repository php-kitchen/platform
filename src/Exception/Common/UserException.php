<?php

namespace PHPKitchen\SPL\Exception\Common;

/**
 * Represents
 *
 * @package PHPKitchen\SPL\Exception\Common
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class UserException extends \Exception {
    public function getName() {
        return 'User Mistake';
    }
}