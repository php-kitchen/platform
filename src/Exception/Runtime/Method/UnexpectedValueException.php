<?php

namespace PHPKitchen\SPL\Exception\Runtime\Method;

/**
 * Represents exception thrown if a value does not match with a set of values. Typically
 * this happens when a function calls another function and expects the return
 * value to be of a certain type or value not including arithmetic or buffer
 * related errors.
 *
 * @package PHPKitchen\SPL\Exception\Runtime\Method
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class UnexpectedValueException extends \UnexpectedValueException {
}