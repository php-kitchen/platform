<?php

namespace PHPKitchen\Platform\Struct {

    function Collection($elements): Collection {
        return Collection::of($elements);
    }

    function Map($elements): Map {
        return Map::of($elements);
    }
}

namespace PHPKitchen\Platform\Data {

    use Stringy\Stringy;

    function String(string $data, $encoding = null): Stringy {
        return Stringy::create($data, $encoding);
    }

    function NullObject(): NullObject {
        return new NullObject();
    }
}
