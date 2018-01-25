<?php

namespace PHPKitchen\Platform\Helper\Collection;

/**
 * Represents
 *
 * @package Helper\Collection
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class Diff {
    protected $collections;

    // @todo support of collection
    public function byValues(): array {
        return array_diff(...$this->collections);
    }

    // @todo support of collection
    public function byKeysComparedBy(callable $compare): array {
        $arguments = $this->collections;
        $arguments[] = $compare;

        return array_diff_ukey(...$arguments);
    }

    // @todo support of collection
    public function byKeys(): array {
        return array_diff_key(...$this->collections);
    }

    // @todo support of collection
    public function byValuesAndKeys(): array {
        return array_diff_assoc(...$this->collections);
    }

    // @todo support of collection
    public function byValuesAndKeysComparedBy(callable $compare): array {
        $arguments = $this->collections;
        $arguments[] = $compare;

        return array_diff_uassoc(...$arguments);
    }
}