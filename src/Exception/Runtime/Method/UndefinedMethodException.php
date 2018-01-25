<?php

namespace PHPKitchen\SPL\Exception\Runtime\Method;

/**
 * Represents exception thrown if a callback refers to an undefined method.
 *
 * @package PHPKitchen\SPL\Exception\Runtime\Method
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class UndefinedMethodException extends \BadMethodCallException {
}