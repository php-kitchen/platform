<?php

namespace PHPKitchen\Platform\Specs\Unit\Mixin;

use PHPKitchen\Platform\Exception\Runtime\Property\InvalidAccessException;
use PHPKitchen\Platform\Exception\Runtime\Property\UndefinedPropertyException;
use PHPKitchen\Platform\Mixin\Properties;
use PHPKitchen\Platform\Specs\Base\Spec;

/**
 * Specification of {@link Properies}
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class PropertiesSpec extends Spec {
    protected const TEST_USER_NAME = 'Alex';
    protected const TEST_USER_SEX = 'Male';

    /**
     * @test
     */
    public function getterAndSetterBehavior() {
        $user = $this->createClassWithProperties();
        $I = $this->tester;
        $I->describe('behavior of read/write available properties');

        $I->verifyThat('property defined by get/set methods is accessible to read and writes');

        $I->expectThat('property is readable');
        $I->lookAt('name property');
        $I->seeString($user->name)
          ->isEqualTo(self::TEST_USER_NAME);

        $user->name = $newName = 'Anton';

        $I->expectThat('property is writable');
        $I->lookAt('name property');
        $I->seeString($user->name)
          ->isEqualTo($newName);
    }

    /**
     * @test
     */
    public function readOnlyPropertyBehavior() {
        $user = $this->createClassWithProperties();
        $I = $this->tester;
        $I->describe('behavior of read only properties');

        $I->verifyThat('property defined by "get" method accessible to read but not to write');

        $I->expectThat('property is readable');
        $I->lookAt('sex property');
        $I->seeString($user->sex)
          ->isEqualTo(self::TEST_USER_SEX);

        $I->expectThat('property is not writable');
        $I->seeObject($user)
          ->throwsException(InvalidAccessException::class)
          ->when(function ($user) {
              $user->sex = 'Female';
          });
    }

    /**
     * @test
     */
    public function writeOnlyPropertyBehavior() {
        $user = $this->createClassWithProperties();
        $I = $this->tester;
        $I->describe('behavior of write only properties');

        $I->verifyThat('property defined by "set" method is accessible to write and not to read');

        $I->expectThat('property is writable');

        $user->punch = 1;

        $I->expectThat('property is not readable');
        $I->seeObject($user)
          ->throwsException(InvalidAccessException::class)
          ->when(function ($user) {
              $p = $user->punch;
          });
    }

    /**
     * @test
     */
    public function undefinedPropertyBehavior() {
        $user = $this->createClassWithProperties();
        $I = $this->tester;
        $I->describe('behavior of undefined properties access');

        $I->expectThat('reading of undefined properties is not allowed');
        $I->seeObject($user)
          ->throwsException(UndefinedPropertyException::class)
          ->when(function ($user) {
              $no = $user->noProperty;
          });

        $I->expectThat('writing to undefined properties is not allowed');
        $I->seeObject($user)
          ->throwsException(UndefinedPropertyException::class)
          ->when(function ($user) {
              $user->noProperty = 123;
          });
    }

    /**
     * @test
     */
    public function conditionalPropertiesBehavior() {
        $user = $this->createClassWithProperties();
        $I = $this->tester;
        $I->describe('behavior of read conditional properties');

        $I->verifyThat('property defined by "is" or "has" method accessible to read but not to write');

        $I->expectThat('"is*" property is readable');
        $I->lookAt('status condition');
        $I->seeBool($user->isActive)
          ->isTrue();

        $I->expectThat('"has*" property is readable');
        $I->lookAt('name status condition');
        $I->seeBool($user->hasName)
          ->isTrue();

        $I->expectThat('"is*" condition property is not writable');
        $I->seeObject($user)
          ->throwsException(UndefinedPropertyException::class)
          ->when(function ($user) {
              $user->isActive = false;
          });

        $I->expectThat('"has*" condition property is not writable');
        $I->seeObject($user)
          ->throwsException(UndefinedPropertyException::class)
          ->when(function ($user) {
              $user->hasName = false;
          });
    }

    protected function createClassWithProperties() {
        return new class {
            use Properties;
            protected $_name = 'Alex';
            protected $_sex = 'Male';
            protected $active = true;

            public function getSex() {
                return $this->_sex;
            }

            public function getName() {
                return $this->_name;
            }

            public function setName($name) {
                $this->_name = $name;
            }

            public function setPunch($p) {
                // just a stub
            }

            public function isActive() {
                return $this->active;
            }

            public function hasName() {
                return !empty($this->_name);
            }
        };
    }
}