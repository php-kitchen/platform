<?php

namespace PHPKitchen\Platform\Specs\Unit\Collection;

use PHPKitchen\Platform\Collection\Map;
use PHPKitchen\Platform\Specs\Base\Spec;

/**
 * Specification for {@link Map}
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class MapTest extends Spec {
    /**
     * @test
     */
    public function constructorBehavior() {
        $map = Map::from([]);
        $this->tester->seeBool($map->isNull())
                     ->isFalse();
    }
}