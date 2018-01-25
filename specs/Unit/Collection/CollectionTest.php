<?php

namespace PHPKitchen\Platform\Specs\Unit\Collection;

use PHPKitchen\Platform\Collection\Collection;
use PHPKitchen\Platform\Specs\Base\Spec;

/**
 * Specification for {@link Collection}
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class CollectionTest extends Spec {
    /**
     * @test
     */
    public function constructorBehavior() {
        $collection = Collection::from([]);
        $this->tester->seeBool($collection->isNull())
                     ->isFalse();
    }
}