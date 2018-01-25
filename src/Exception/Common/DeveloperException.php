<?php

namespace PHPKitchen\SPL\Exception\Common;

/**
 * Represents exception thrown because of action of a developer.
 *
 * @package PHPKitchen\SPL\Exception\Environment
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class DeveloperException extends \Exception {
    public function getName() {
        return 'Developer Mistake';
    }
}