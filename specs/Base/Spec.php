<?php

namespace PHPKitchen\Platform\Specs\Base;

use PHPKitchen\CodeSpecs\Base\Specification;

/**
 * Represents base class for all of the test cases.
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
abstract class Spec extends Specification {
    protected const FIXTURES_DIR = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Fixtures' . DIRECTORY_SEPARATOR;
}