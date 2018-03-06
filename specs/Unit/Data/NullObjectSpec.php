<?php

namespace PHPKitchen\Platform\Specs\Unit\Struct;

use PHPKitchen\Platform\Data\NullObject;
use PHPKitchen\Platform\Specs\Base\Spec;

/**
 * Specification for {@link NullObject}
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class NullObjectSpec extends Spec {
    /**
     * @test
     */
    public function objectBehavior() {
        $nullObject = new NullObject();

        $I = $this->tester;
        $I->describe('behavior of null object');

        $I->expectThat('NullObject check methods always always show it as null and empty');
        $I->seeBool($nullObject->isNull())
          ->isTrue();
        $I->seeBool($nullObject->isEmpty())
          ->isTrue();

        $I->expectThat('NullObject is always equal to `null` and NullObject\'s');
        $I->seeBool($nullObject->isEqualTo(null))
          ->isTrue();
        $I->seeBool($nullObject->isEqualTo(new NullObject()))
          ->isTrue();
    }
}