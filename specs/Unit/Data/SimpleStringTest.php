<?php

namespace PHPKitchen\Platform\Specs\Unit\Collection;

use PHPKitchen\Platform\Data\SimpleString;
use PHPKitchen\Platform\Specs\Base\Spec;

/**
 * Specification for {@link SimpleString}
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class SimpleStringTest extends Spec {
    /**
     * @test
     */
    public function constructorBehavior() {
        $map = SimpleString::from('');
        $this->tester->seeBool($map->isNull())
                     ->isFalse();
    }
}