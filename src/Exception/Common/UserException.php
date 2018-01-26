<?php

namespace PHPKitchen\Platform\Exception\Common;

/**
 * Represents
 *
 * @package PHPKitchen\Platform\Exception\Common
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class UserException extends \Exception {
    public function getName() {
        return 'User Mistake';
    }
}