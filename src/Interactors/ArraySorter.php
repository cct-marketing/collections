<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Interactors;

use CCT\Component\Collections\CollectionInterface;

class ArraySorter extends AbstractInteractor
{
    /**
     * Sort the elements.
     *
     * @param int  $order           Possible values: SORT_ASC or SORT_DESC
     * @param int  $strategy        @see http://php.net/manual/en/function.sort.php#refsect1-function.sort-parameters
     * @param bool $preserveKeys    Preserve or not the keys
     */
    public function sort(int $order = SORT_ASC, int $strategy = SORT_REGULAR, bool $preserveKeys = false): array
    {
        $this->applySorting($order, $strategy, $preserveKeys);

        return $this->elements;
    }

    /**
     * Sort the elements by keys.
     *
     * @param int $order        Possible values: SORT_ASC or SORT_DESC
     * @param int $strategy     @see http://php.net/manual/en/function.sort.php#refsect1-function.sort-parameters
     */
    public function sortByKeys(int $order = SORT_ASC, int $strategy = SORT_REGULAR): array
    {
        $this->applySortingByKeys($order, $strategy);

        return $this->elements;
    }

    /**
     * Shuffle the array and return the result.
     */
    public function shuffle(): array
    {
        shuffle($this->elements);

        return $this->elements;
    }

    private function applySorting($order = SORT_ASC, $strategy = SORT_REGULAR, $preserveKeys = false): void
    {
        if (SORT_ASC === $order) {
            $this->sortByAscendingOrder($strategy, $preserveKeys);
            return;
        }

        if (SORT_DESC === $order) {
            $this->sortByDescendingOrder($strategy, $preserveKeys);
            return;
        }

        throw new \InvalidArgumentException(sprintf(
            'The order "%s" given is invalid. The accepted orders are: SORT_ASC or SORT_DESC',
            $order
        ));
    }

    private function sortByAscendingOrder($strategy, $preserveKeys): void
    {
        if (true === $preserveKeys) {
            asort($this->elements, $strategy);
            return;
        }

        sort($this->elements, $strategy);
    }

    private function sortByDescendingOrder($strategy, $preserveKeys): void
    {
        if (true === $preserveKeys) {
            arsort($this->elements, $strategy);
            return;
        }

        rsort($this->elements, $strategy);
    }

    private function applySortingByKeys($order = SORT_ASC, $strategy = SORT_REGULAR): void
    {
        if (SORT_ASC === $order) {
            ksort($this->elements, $strategy);
            return;
        }

        if (SORT_DESC === $order) {
            krsort($this->elements, $strategy);
            return;
        }

        throw new \InvalidArgumentException(sprintf(
            'The order "%s" given is invalid. The accepted orders are: SORT_ASC or SORT_DESC',
            $order
        ));
    }
}
