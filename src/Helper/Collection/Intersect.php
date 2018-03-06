<?php

namespace PHPKitchen\Platform\Helper\Collection;

/**
 * Represents
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 * @since 1.0
 */
class Intersect {
    protected $collections;

    // @todo support of collection
    public function byValues(): array {
        return array_intersect(...$this->collections);
    }

    // @todo support of collection
    public function byKeysComparedBy(callable $compare): array {
        $arguments = $this->collections;
        $arguments[] = $compare;

        return array_intersect_ukey(...$arguments);
    }

    // @todo support of collection
    public function byKeys(): array {
        return array_intersect_key(...$this->collections);
    }

    // @todo support of collection
    public function byValuesAndKeys(): array {
        return array_intersect_assoc(...$this->collections);
    }

    // @todo support of collection
    public function byValuesAndKeysComparedBy(callable $compare): array {
        $arguments = $this->collections;
        $arguments[] = $compare;

        return array_intersect_uassoc(...$arguments);
    }
}