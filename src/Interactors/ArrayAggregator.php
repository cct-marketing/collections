<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Interactors;

use CCT\Component\Collections\CollectionInterface;

class ArrayAggregator extends AbstractInteractor
{
    /**
     * Merge one or more arrays by a new set.
     *
     * @param array $elements One or more arrays
     *
     * @return array|CollectionInterface
     */
    public function merge(...$elements): array
    {
        $this->elements = array_merge($this->elements, ...$elements);

        return $this->elements;
    }

    /**
     * Merge one or more arrays recursively by a new set.
     *
     * @param array $elements One or more arrays
     *
     * @return array|CollectionInterface
     */
    public function mergeRecursive(...$elements): array
    {
        $this->elements = array_merge_recursive($this->elements, ...$elements);

        return $this->elements;
    }

    /**
     * Replace one or more arrays recursively by a new set.
     *
     * @param array $elements One or more arrays
     *
     * @return array|CollectionInterface
     */
    public function replace(...$elements): array
    {
        $this->elements = array_replace($this->elements, ...$elements);

        return $this->elements;
    }

    /**
     * Replace recursively one or more arrays recursively by a new set.
     *
     * @param array $elements One or more arrays
     *
     * @return array|CollectionInterface
     */
    public function replaceRecursive(...$elements): array
    {
        $this->elements = array_replace_recursive($this->elements, ...$elements);

        return $this->elements;
    }

    /**
     * Pushes one or more array to the end of the array.
     *
     * @param array ...$elements One or more arrays
     *
     * @return array
     */
    public function append(...$elements): array
    {
        array_push($this->elements, ...$elements);

        return $this->elements;
    }

    /**
     * Pushes one or more array to the beginning of the array.
     *
     * @param array ...$elements One or more arrays
     *
     * @return array
     */
    public function prepend(...$elements): array
    {
        array_unshift($this->elements, ...$elements);

        return $this->elements;
    }
}
