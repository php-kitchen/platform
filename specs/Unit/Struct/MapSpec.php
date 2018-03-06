<?php

namespace PHPKitchen\Platform\Specs\Unit\Struct;

use PHPKitchen\Platform\Specs\Base\Spec;
use PHPKitchen\Platform\Struct\Collection;
use PHPKitchen\Platform\Struct\Map;

/**
 * Specification for {@link Map}
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class MapSpec extends Spec {
    protected const INVALID_KEY_ERROR_MESSAGE = 'Map support only `string` keys.';

    /**
     * @test
     */
    public function constructorBehavior() {

        $I = $this->tester;
        $I->describe('constructor `behavior`');

        try {
            Map::of([1, 2, 3]);
            $errorMessage = 'Constructor validation failed';
        } catch (\Throwable $error) {
            $errorMessage = $error->getMessage();
        }

        $I->expectThat('Map reject arrays with non-string keys');
        $I->seeString($errorMessage)
          ->isEqualTo(self::INVALID_KEY_ERROR_MESSAGE);
    }

    /**
     * @test
     */
    public function isEmptyBehavior() {
        $I = $this->tester;

        $I->describe('behavior of empty assert method');
        $map = Map::of([
            'first' => 1,
            'second' => 2,
            'third' => 3,
        ]);

        $I->expectThat('collection with data considered as not empty');
        $I->seeBool($map->isEmpty())
          ->isFalse();

        $map = Map::of([]);

        $I->expectThat('collection without data considered as empty');
        $I->seeBool($map->isEmpty())
          ->isTrue();
    }

    /**
     * @test
     */
    public function clearBehavior() {
        $I = $this->tester;

        $I->describe('behavior of collection cleaning method');
        $map = Map::of([
            'first' => 1,
            'second' => 2,
            'third' => 3,
        ]);
        $map->clear();

        $I->expectThat('after cleaning collection become empty');
        $I->seeBool($map->isEmpty())
          ->isTrue();
    }

    /**
     * @test
     */
    public function hasMethodsGroupBehavior() {
        $I = $this->tester;

        $I->describe('behavior of "has" methods group');
        $map = Map::of([
            'first' => 1,
            'second' => 2,
            'third' => 3,
            'null-element' => null,
        ]);

        $I->expectThat('`hasKey` returns `true` for existing and `false` for not existing keys');
        $I->seeBool($map->hasKey($firstElementKey = 'first'))
          ->isTrue();
        $I->seeBool($map->hasKey($notExistingKey = 'not-exists'))
          ->isFalse();

        $I->expectThat('`has` returns `true` for existing and `false` for not existing element');
        $I->seeBool($map->has($secondElement = 2))
          ->isTrue();
        $I->seeBool($map->has($notExistingElement = 56))
          ->isFalse();

        $I->expectThat('`hasSet` returns `true` for set and `false` for not set and null elements at specified key');
        $I->seeBool($map->hasSet($firstElementKey = 'first'))
          ->isTrue();
        $I->seeBool($map->hasSet($nullElementKey = 'null-element'))
          ->isFalse();
        $I->seeBool($map->hasSet($notExistingElementKey = 'not-exists'))
          ->isFalse();
    }

    /**
     * @test
     */
    public function removeMethodsGroupBehavior() {
        $I = $this->tester;

        $I->describe('behavior of "remove" methods group');
        $map = Map::of([
            'first' => 1,
            'first-duplicate-1' => 3,
            'first-duplicate-2' => 3,
            'first-duplicate-3' => 3,
            'second-duplicate-1' => 4,
            'second-duplicate-2' => 4,
            'second-duplicate-3' => 4,
        ]);

        $I->expectThat('`removeAt` unset element with specified key');

        $map->removeAt($firstElementKey = 'first');
        $I->seeBool($map->hasKey($firstElementKey = 'first'))
          ->isFalse();

        $I->expectThat('`remove` unset first occurrences of specified element');

        $map->remove($elementWithDuplicates = 3);
        $I->seeBool($map->hasKey('first-duplicate-1'))
          ->isFalse();
        $I->seeBool($map->hasKey('first-duplicate-2'))
          ->isTrue();
        $I->seeBool($map->hasKey('first-duplicate-3'))
          ->isTrue();

        $I->expectThat('`removeAll` unset all occurrences of specified element');

        $map->removeAll($secondDuplicate = 4);
        $I->seeBool($map->has($secondDuplicate = 4))
          ->isFalse();
    }

    /**
     * @test
     */
    public function onEachBehavior() {
        $I = $this->tester;

        $I->describe('`onEach` behavior');

        $map = Map::of([
            'first' => 1,
            'second' => 2,
            'third' => 3,
        ]);

        $I->expectThat('callback does not modify elements passed by value');

        $map->onEach(function ($element) {
            $element++;
        });
        $I->see($map)
          ->isEqualTo(Map::of([
              'first' => 1,
              'second' => 2,
              'third' => 3,
          ]));

        $I->expectThat('callback can modify elements passed by link');

        $map->onEach(function (&$element) {
            $element++;
        });
        $I->see($map)
          ->isEqualTo(Map::of([
              'first' => 2,
              'second' => 3,
              'third' => 4,
          ]));
    }

    /**
     * @test
     */
    public function onEachRecursiveBehavior() {
        $I = $this->tester;

        $I->describe('`onEachRecursive` behavior');

        $map = Map::of([
            'first' => 1,
            'second' => 2,
            'third' => 3,
            'sub-collection' => [
                'first' => 1,
                'second' => 2,
                'third' => 3,
            ],
        ]);

        $I->expectThat('callback does not modify elements passed by value');

        $map->onEachRecursive(function ($element) {
            $element++;
        });
        $I->see($map)
          ->isEqualTo(Map::of([
              'first' => 1,
              'second' => 2,
              'third' => 3,
              'sub-collection' => [
                  'first' => 1,
                  'second' => 2,
                  'third' => 3,
              ],
          ]));

        $I->expectThat('callback can modify elements passed by link');

        $map->onEachRecursive(function (&$element) {
            $element++;
        });
        $I->see($map)
          ->isEqualTo(Map::of([
              'first' => 2,
              'second' => 3,
              'third' => 4,
              'sub-collection' => [
                  'first' => 2,
                  'second' => 3,
                  'third' => 4,
              ],
          ]));
    }

    /**
     * @test
     */
    public function filterBehavior() {
        $I = $this->tester;

        $I->describe('`filter` behavior');

        $map = Map::of([
            'first' => 1,
            'second' => 2,
            'third' => 3,
            'third-duplicate' => 3,
        ]);

        $I->expectThat('filter callable is able to change the collection ');

        $filteredCollection = $map->filter(function ($element) {
            if ($element == 3) {
                return false;
            };

            return true;
        });
        $I->lookAt('collection filtered from `3` elements');
        $I->see($filteredCollection)
          ->isEqualTo(Map::of([
              'first' => 1,
              'second' => 2,
          ]));
    }

    /**
     * @test
     */
    public function mapBehavior() {
        $I = $this->tester;

        $I->describe('`map` behavior');

        $map = Map::of([
            'first' => 1,
            'second' => 2,
            'third' => 3,
        ]);

        $I->expectThat('map callable is able to change the collection ');

        $mappedCollection = $map->map(function ($element) {
            return $element * $element;
        });
        $I->lookAt('collection mapped by `square` function');
        $I->see($mappedCollection)
          ->isEqualTo(Map::of([
              'first' => 1,
              'second' => 4,
              'third' => 9,
          ]));
    }

    /**
     * @test
     */
    public function reduceBehavior() {
        $I = $this->tester;

        $I->describe('`reduce` behavior');

        $map = Map::of([
            'first' => 1,
            'second' => 2,
            'third' => 3,
        ]);

        $I->expectThat('reduce callable is able to traverse through collection');

        $reduceValue = $map->reduce(function ($result, $element) {
            $result += $element;

            return $result;
        });
        $I->lookAt('reduce callable is able to traverse through collection with initial value set');
        $I->seeNumber($reduceValue)
          ->isEqualTo($sumOfCollection = 6);
        $I->expectThat('reduce callable is able to change the collection ');

        $reduceValue = $map->reduce(function ($result, $element) {
            $result += $element;

            return $result;
        }, 4);
        $I->lookAt('collection value reduced by `sum` function with initial value');
        $I->seeNumber($reduceValue)
          ->isEqualTo($sumOfCollectionWithInitialValue = 10);
    }

    /**
     * @test
     */
    public function keyMethodsGroupBehavior() {
        $I = $this->tester;

        $I->describe('`key` methods group behavior');

        $map = Map::of([
            'first' => 1,
            'second' => 2,
            'third' => 3,
            'first-third-duplicate' => 3,
            'second-third-duplicate' => 3,
        ]);

        $I->expectThat('`keyOf` return key of a first occurrence of given element');

        $firstKeyOfDuplicate = $map->keyOf(3);
        $I->lookAt('key of duplicated element');
        $I->seeNumber($firstKeyOfDuplicate)
          ->isEqualTo('third');

        $I->expectThat('`lastKeyOf` return key of a last occurrence of given element');

        $lastKeyOfDuplicate = $map->lastKeyOf(3);
        $I->lookAt('last key of duplicated element');
        $I->seeNumber($lastKeyOfDuplicate)
          ->isEqualTo('second-third-duplicate');

        $I->expectThat('`allKeysOf` return collection of keys of all occurrences of given element');

        $allKeysOfDuplicate = $map->allKeysOf(3);
        $I->lookAt('collection duplicated element keys');
        $I->seeArray($allKeysOfDuplicate)
          ->isEqualTo(Collection::of([
              'third',
              'first-third-duplicate',
              'second-third-duplicate',
          ]));
    }

    /**
     * @test
     */
    public function countValuesFrequencyBehavior() {
        $I = $this->tester;

        $I->describe('`countValuesFrequency` methods group behavior');

        $map = Map::of([
            'first' => 1,
            'second' => 3,
            'first-second-duplicate' => 3,
            'second-second-duplicate' => 3,
            'Name' => 'Sam',
            'name' => 'sam',
        ]);

        $I->expectThat('`countValuesFrequency` honor string values case');

        $caseSensitiveFrequency = $map->countValuesFrequency();
        $I->lookAt('case sensitive values frequency');
        $I->see($caseSensitiveFrequency)
          ->isEqualTo(Collection::of([
              3 => 3,
              1 => 1,
              'Sam' => 1,
              'sam' => 1,
          ]));

        $I->expectThat('`countValuesFrequency` honor string values case');

        $caseSensitiveFrequency = $map->countValuesFrequencyIgnoringCase();
        $I->lookAt('case sensitive values frequency');
        $I->see($caseSensitiveFrequency)
          ->isEqualTo(Collection::of([
              3 => 3,
              1 => 1,
              'sam' => 2,
          ]));
    }

    /**
     * @test
     */
    public function calculateProductBehavior() {
        $I = $this->tester;

        $I->describe('`calculateProduct` behavior');

        $map = Map::of([
            'first' => 2,
            'second' => 4,
            'third' => 3,
        ]);

        $I->expectThat('numeric collection product can be calculated');

        $mapProduct = $map->calculateProduct();

        $I->seeNumber($mapProduct)
          ->isEqualTo(24);

        $map = Map::of([
            'first' => 2,
            'second' => 'hi',
            'third' => 'there',
        ]);

        $I->expectThat('mixed collection product can be calculated');

        $mapProduct = $map->calculateProduct();

        $I->seeNumber($mapProduct)
          ->isEqualTo(0);
    }

    /**
     * @test
     */
    public function popBehavior() {
        $I = $this->tester;

        $I->describe('`pop` behavior');

        $map = Map::of([
            'first' => 2,
            'second' => 4,
            'third' => 3,
        ]);

        $I->expectThat('`pop` ejects last element fro the collection');

        $poppedElement = $map->pop();

        $I->lookAt('popped element');
        $I->seeNumber($poppedElement)
          ->isEqualTo($lastCollectionElement = 3);
        $I->lookAt('collection without last(popped) element');
        $I->see($map)
          ->isEqualTo(Map::of([
              'first' => 2,
              'second' => 4,
          ]));
    }

    /**
     * @test
     */
    public function shiftBehavior() {
        $I = $this->tester;

        $I->describe('`shift` behavior');

        $map = Map::of([
            'first' => 2,
            'second' => 4,
            'third' => 3,
        ]);

        $I->expectThat('`shift` ejects first element fro the collection');

        $poppedElement = $map->shift();

        $I->lookAt('shifted element');
        $I->seeNumber($poppedElement)
          ->isEqualTo($firstCollectionElement = 2);
        $I->lookAt('collection without first(shifted) element');
        $I->see($map)
          ->isEqualTo(Map::of([
              'second' => 4,
              'third' => 3,
          ]));
    }

    /**
     * @test
     */
    public function keysToLoweCaseBehavior() {
        $I = $this->tester;

        $I->describe('`keysToLowerCase` behavior');

        $map = Map::of([
            'FIRST' => 2,
            'SecoND' => 4,
            'thirD' => 3,
        ]);

        $I->expectThat('`keysToLowerCase` convert all of the collection keys with any notation to lower case');

        $map->keysToLowerCase();

        $I->see($map)
          ->isEqualTo(Map::of([
              'first' => 2,
              'second' => 4,
              'third' => 3,
          ]));
    }

    /**
     * @test
     */
    public function keysToUpperCaseBehavior() {
        $I = $this->tester;

        $I->describe('`keysToLowerCase` behavior');

        $map = Map::of([
            'FIRST' => 2,
            'SecoND' => 4,
            'thirD' => 3,
            'forth' => 3,
        ]);

        $I->expectThat('`keysToLowerCase` convert all of the collection keys with any notation to lower case');

        $map->keysToUpperCase();

        $I->see($map)
          ->isEqualTo(Map::of([
              'FIRST' => 2,
              'SECOND' => 4,
              'THIRD' => 3,
              'FORTH' => 3,
          ]));
    }

    /**
     * @test
     */
    public function chunkByBehavior() {
        $I = $this->tester;

        $I->describe('`chunkBy` behavior');

        $map = Map::of([
            'FIRST' => 2,
            'SECOND' => 4,
            'THIRD' => 3,
            'FORTH' => 3,
        ]);

        $I->expectThat('`chunkBy` split collection on chunks with specified size.');

        $chunks = $map->chunkBy(2);
        $I->see($chunks)
          ->isEqualTo(Collection::of([
              Map::of([
                  'FIRST' => 2,
                  'SECOND' => 4,
              ]),
              Map::of([
                  'THIRD' => 3,
                  'FORTH' => 3,
              ]),
          ]));
    }

    /**
     * @test
     */
    public function arrayAccessBehavior() {
        $I = $this->tester;

        $I->describe('array access behavior');

        $map = Map::of([]);

        $I->expectThat('map allows to set and read values through array access');

        $map['first'] = 1;

        $I->see($map['first'])
          ->isEqualTo(1);

        $I->expectThat('not set keys return `null` and considered as not set');

        $I->seeBool(isset($map['not-existing']))
          ->isFalse();
        $I->see($map['not-existing'])
          ->isNull();

        $I->expectThat('Map reject non-string keys');

        try {
            $map[] = 4;
            $errorMessage = 'Key validation failed';
        } catch (\Throwable $error) {
            $errorMessage = $error->getMessage();
        }

        $I->seeString($errorMessage)
          ->isEqualTo(self::INVALID_KEY_ERROR_MESSAGE);
    }
}