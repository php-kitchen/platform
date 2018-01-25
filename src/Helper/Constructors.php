<?php

namespace PHPKitchen\Platform\Collection {

    function Collection($data): Collection {
        return Collection::from($data);
    }

    function Map($data): Map {
        return Map::from($data);
    }
}

namespace PHPKitchen\Platform\Data {

    function String($data): SimpleString {
        return SimpleString::from($data);
    }

    function Null(): NullObject {
        return new NullObject();
    }
}
