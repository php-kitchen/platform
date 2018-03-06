<?php

namespace PHPKitchen\Platform\Exception\Environment;

use PHPKitchen\Platform\Exception\Common\DeveloperException;
use PHPKitchen\Platform\Exception\Mixin\StaticConstructors;

/**
 * Represents exception thrown if application or class configuration is
 * invalid.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class InvalidConfigException extends DeveloperException {
    use StaticConstructors;
}