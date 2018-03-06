<?php

namespace PHPKitchen\Platform\Specs\Unit\Struct;

use PHPKitchen\Platform\Specs\Base;
use PHPKitchen\Platform\Struct\Collection;

/**
 * Specification for {@link Collection}
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class CollectionSpec extends Base\Spec {
    /**
     * @test
     */
    public function constructorBehavior() {
        $collection = Collection::of([]);
        $this->tester->seeBool($collection->isNull())
                     ->isFalse();
    }

    /**
     * @test
     */
    public function isEmptyBehavior() {
        $I = $this->tester;

        $I->describe('behavior of empty assert method');
        $collection = Collection::of([1, 2, 3]);

        $I->expectThat('collection with data considered as not empty');
        $I->seeBool($collection->isEmpty())
          ->isFalse();

        $collection = Collection::of([]);

        $I->expectThat('collection without data considered as empty');
        $I->seeBool($collection->isEmpty())
          ->isTrue();
    }

    /**
     * @test
     */
    public function clearBehavior() {
        $I = $this->tester;

        $I->describe('behavior of collection cleaning method');
        $collection = Collection::of([1, 2, 3]);
        $collection->clear();

        $I->expectThat('after cleaning collection become empty');
        $I->seeBool($collection->isEmpty())
          ->isTrue();
    }

    /**
     * @test
     */
    public function hasMethodsGroupBehavior() {
        $I = $this->tester;

        $I->describe('behavior of "has" methods group');
        $collection = Collection::of([1, 2, 3, null]);

        $I->expectThat('`hasKey` returns `true` for existing and `false` for not existing keys');
        $I->seeBool($collection->hasKey($firstElementKey = 0))
          ->isTrue();
        $I->seeBool($collection->hasKey($notExistingKey = 5))
          ->isFalse();

        $I->expectThat('`has` returns `true` for existing and `false` for not existing element');
        $I->seeBool($collection->has($secondElement = 2))
          ->isTrue();
        $I->seeBool($collection->has($notExistingElement = 56))
          ->isFalse();

        $I->expectThat('`hasSet` returns `true` for set and `false` for not set and null elements at specified key');
        $I->seeBool($collection->hasSet($firstElementKey = 0))
          ->isTrue();
        $I->seeBool($collection->hasSet($nullElementKey = 3))
          ->isFalse();
        $I->seeBool($collection->hasSet($notExistingElementKey = 5))
          ->isFalse();
    }

    /**
     * @test
     */
    public function removeMethodsGroupBehavior() {
        $I = $this->tester;

        $I->describe('behavior of "remove" methods group');
        $collection = Collection::of([
            1,
            3,
            3,
            3,
            4,
            4,
            4,
        ]);

        $I->expectThat('`removeAt` unset element with specified key');

        $collection->removeAt($firstElementKey = 0);
        $I->seeBool($collection->hasKey($firstElementKey = 0))
          ->isFalse();

        $I->expectThat('`remove` unset first occurrences of specified element');

        $collection->remove($elementWithDuplicates = 3);
        $I->seeBool($collection->hasKey($firstDuplicateKey = 1))
          ->isFalse();
        $I->seeBool($collection->hasKey($secondDuplicateKey = 2))
          ->isTrue();
        $I->seeBool($collection->hasKey($thirdDuplicateKey = 3))
          ->isTrue();

        $I->expectThat('`removeAll` unset all occurrences of specified element');

        $collection->removeAll($secondDuplicate = 4);
        $I->seeBool($collection->has($secondDuplicate = 4))
          ->isFalse();
    }

    /**
     * @test
     */
    public function onEachBehavior() {
        $I = $this->tester;

        $I->describe('`onEach` behavior');

        $collection = Collection::of([1, 2, 3]);

        $I->expectThat('callback does not modify elements passed by value');

        $collection->onEach(function ($element) {
            $element++;
        });
        $I->see($collection)
          ->isEqualTo(Collection::of([1, 2, 3]));

        $I->expectThat('callback can modify elements passed by link');

        $collection->onEach(function (&$element) {
            $element++;
        });
        $I->see($collection)
          ->isEqualTo(Collection::of([2, 3, 4]));
    }

    /**
     * @test
     */
    public function onEachRecursiveBehavior() {
        $I = $this->tester;

        $I->describe('`onEachRecursive` behavior');

        $collection = Collection::of([1, 2, 3, [1, 2, 3]]);

        $I->expectThat('callback does not modify elements passed by value');

        $collection->onEachRecursive(function ($element) {
            $element++;
        });
        $I->see($collection)
          ->isEqualTo(Collection::of([1, 2, 3, [1, 2, 3]]));

        $I->expectThat('callback can modify elements passed by link');

        $collection->onEachRecursive(function (&$element) {
            $element++;
        });
        $I->see($collection)
          ->isEqualTo(Collection::of([2, 3, 4, [2, 3, 4]]));
    }

    /**
     * @test
     */
    public function filterBehavior() {
        $I = $this->tester;

        $I->describe('`filter` behavior');

        $collection = Collection::of([1, 2, 3, 3]);

        $I->expectThat('filter callable is able to change the collection ');

        $filteredCollection = $collection->filter(function ($element) {
            if ($element == 3) {
                return false;
            };

            return true;
        });
        $I->lookAt('collection filtered from `3` elements');
        $I->see($filteredCollection)
          ->isEqualTo(Collection::of([1, 2]));
    }

    /**
     * @test
     */
    public function mapBehavior() {
        $I = $this->tester;

        $I->describe('`map` behavior');

        $collection = Collection::of([1, 2, 3]);

        $I->expectThat('map callable is able to change the collection ');

        $mappedCollection = $collection->map(function ($element) {
            return $element * $element;
        });
        $I->lookAt('collection mapped by `square` function');
        $I->see($mappedCollection)
          ->isEqualTo(Collection::of([1, 4, 9]));
    }

    /**
     * @test
     */
    public function reduceBehavior() {
        $I = $this->tester;

        $I->describe('`reduce` behavior');

        $collection = Collection::of([1, 2, 3]);

        $I->expectThat('reduce callable is able to traverse through collection');

        $reduceValue = $collection->reduce(function ($result, $element) {
            $result += $element;

            return $result;
        });
        $I->lookAt('reduce callable is able to traverse through collection with initial value set');
        $I->seeNumber($reduceValue)
          ->isEqualTo($sumOfCollection = 6);
        $I->expectThat('reduce callable is able to change the collection ');

        $reduceValue = $collection->reduce(function ($result, $element) {
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

        $collection = Collection::of([1, 2, 3, 3, 3]);

        $I->expectThat('`keyOf` return key of a first occurrence of given element');

        $firstKeyOfDuplicate = $collection->keyOf(3);
        $I->lookAt('key of duplicated element');
        $I->seeNumber($firstKeyOfDuplicate)
          ->isEqualTo(2);

        $I->expectThat('`lastKeyOf` return key of a last occurrence of given element');

        $lastKeyOfDuplicate = $collection->lastKeyOf(3);
        $I->lookAt('last key of duplicated element');
        $I->seeNumber($lastKeyOfDuplicate)
          ->isEqualTo(4);

        $I->expectThat('`allKeysOf` return collection of keys of all occurrences of given element');

        $allKeysOfDuplicate = $collection->allKeysOf(3);
        $I->lookAt('collection duplicated element keys');
        $I->seeArray($allKeysOfDuplicate)
          ->isEqualTo(Collection::of([2, 3, 4]));
    }

    /**
     * @test
     */
    public function countValuesFrequencyBehavior() {
        $I = $this->tester;

        $I->describe('`countValuesFrequency` methods group behavior');

        $collection = Collection::of([3, 3, 3, 1, 'Sam', 'sam']);

        $I->expectThat('`countValuesFrequency` honor string values case');

        $caseSensitiveFrequency = $collection->countValuesFrequency();
        $I->lookAt('case sensitive values frequency');
        $I->see($caseSensitiveFrequency)
          ->isEqualTo(Collection::of([
              3 => 3,
              1 => 1,
              'Sam' => 1,
              'sam' => 1,
          ]));

        $I->expectThat('`countValuesFrequency` honor string values case');

        $caseSensitiveFrequency = $collection->countValuesFrequencyIgnoringCase();
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

        $collection = Collection::of([2, 4, 3]);

        $I->expectThat('numeric collection product can be calculated');

        $collectionProduct = $collection->calculateProduct();

        $I->seeNumber($collectionProduct)
          ->isEqualTo(24);

        $collection = Collection::of([2, 'hi', 'there']);

        $I->expectThat('mixed collection product can be calculated');

        $collectionProduct = $collection->calculateProduct();

        $I->seeNumber($collectionProduct)
          ->isEqualTo(0);
    }

    /**
     * @test
     */
    public function popBehavior() {
        $I = $this->tester;

        $I->describe('`pop` behavior');

        $collection = Collection::of([2, 4, 3]);

        $I->expectThat('`pop` ejects last element fro the collection');

        $poppedElement = $collection->pop();

        $I->lookAt('popped element');
        $I->seeNumber($poppedElement)
          ->isEqualTo($lastCollectionElement = 3);
        $I->lookAt('collection without last(popped) element');
        $I->see($collection)
          ->isEqualTo(Collection::of([2, 4]));
    }

    /**
     * @test
     */
    public function shiftBehavior() {
        $I = $this->tester;

        $I->describe('`shift` behavior');

        $collection = Collection::of([2, 4, 3]);

        $I->expectThat('`shift` ejects first element fro the collection');

        $poppedElement = $collection->shift();

        $I->lookAt('shifted element');
        $I->seeNumber($poppedElement)
          ->isEqualTo($firstCollectionElement = 2);
        $I->lookAt('collection without first(shifted) element');
        $I->see($collection)
          ->isEqualTo(Collection::of([4, 3]));
    }

    /**
     * @test
     */
    public function addBehavior() {
        $I = $this->tester;

        $I->describe('`add` method behavior');
        $collection = Collection::of([1, 2]);

        $I->expectThat('`add` method push element to the end of the collection');

        $collection->add(3);
        $I->see($collection)
          ->isEqualTo(Collection::of([1, 2, 3]));
    }

    /**
     * @test
     */
    public function pushBehavior() {
        $I = $this->tester;

        $I->describe('`push` method behavior');
        $collection = Collection::of([1, 2]);

        $I->expectThat('`push` with one argument push passed value to the end of the collection');

        $collection->push(3);
        $I->see($collection)
          ->isEqualTo(Collection::of([1, 2, 3]));
        $I->expectThat('`push` with several arguments push all of the elements to the end of the collection keeping order');

        $collection->push(4, 5);
        $I->see($collection)
          ->isEqualTo(Collection::of([1, 2, 3, 4, 5]));
    }

    /**
     * @test
     */
    public function padBehavior() {
        $I = $this->tester;

        $I->describe('`pad` method behavior');

        $I->expectThat('`pad` with positive size add given value to the right side of the collection till collection rich required size');

        $collection = Collection::of([1, 2]);
        $collection->pad(4, 9);
        $I->see($collection)
          ->isEqualTo(Collection::of([1, 2, 9, 9]));

        $I->expectThat('`pad` with negative size add given value to the left side of the collection till collection rich required size');

        $collection = Collection::of([1, 2, 3]);
        $collection->pad(-4, 9);
        $I->see($collection)
          ->isEqualTo(Collection::of([9, 1, 2, 3]));
    }

    /**
     * @test
     */
    public function chunkByBehavior() {
        $I = $this->tester;

        $I->describe('`chunkBy` methods group behavior');

        $collection = Collection::of([1, 2, 3, 4]);

        $I->expectThat('`chunkBy` split collection on chunks with specified size not keeping original keys.');

        $chunks = $collection->chunkBy(2);
        $I->see($chunks)
          ->isEqualTo(Collection::of([
              Collection::of([1, 2]),
              Collection::of([3, 4]),
          ]));

        $I->expectThat('`chunkKeepingKeysBy` split collection on chunks with specified size keeping original keys.');

        $chunks = $collection->chunkKeepingKeysBy(2);
        $I->see($chunks)
          ->isEqualTo(Collection::of([
              Collection::of([0 => 1, 1 => 2]),
              Collection::of([2 => 3, 3 => 4]),
          ]));
    }

    /**
     * @test
     */
    public function arrayAccessBehavior() {
        $I = $this->tester;

        $I->describe('array access behavior');

        $collection = Collection::of([]);

        $I->expectThat('collection allows to set and read values through array access');

        $collection[0] = 1;
        $collection['first'] = 1;

        $I->see($collection[0])
          ->isEqualTo(1);
        $I->see($collection['first'])
          ->isEqualTo(1);

        $I->expectThat('not set keys return `null` and considered as not set');

        $I->seeBool(isset($collection['not-existing']))
          ->isFalse();
        $I->see($collection['not-existing'])
          ->isNull();
    }
}