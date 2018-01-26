<?php

namespace PHPKitchen\Platform\Exception\Common;

/**
 * Represents exception thrown because of action of a developer.
 *
 * @package PHPKitchen\Platform\Exception\Environment
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class DeveloperException extends \Exception {
    public function getName() {
        return 'Developer Mistake';
    }
}