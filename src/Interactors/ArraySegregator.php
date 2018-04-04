<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Interactors;

class ArraySegregator extends AbstractInteractor
{
    /**
     * Pops one or more elements from the end of the elements.
     *
     * @return void
     */
    public function pop(): void
    {
        array_pop($this->elements);
    }

    /**
     * Shifts the first element from the array.
     *
     * @return void
     */
    public function shift(): void
    {
        array_shift($this->elements);
    }

    /**
     * Applies the given function to each element in the collection and returns
     * a new collection with the elements returned by the function.
     *
     * @param \Closure $func
     *
     * @return array
     */
    public function map(\Closure $func): array
    {
        return array_map($func, $this->elements);
    }

    /**
     * Returns all the elements of this collection that satisfy the predicate p.
     * The order of the elements is preserved.
     *
     * @param \Closure $p The predicate used for filtering.
     *
     * @return array A collection with the results of the filter operation.
     */
    public function filter(\Closure $p): array
    {
        return array_filter($this->elements, $p);
    }

    /**
     * Partitions this collection in two collections according to a predicate.
     * Keys are preserved in the resulting collections.
     *
     * @param \Closure $p The predicate on which to partition.
     *
     * @return array[]    An array with two elements. The first element contains the collection
     *                    of elements where the predicate returned TRUE, the second element
     *                    contains the collection of elements where the predicate returned FALSE.
     */
    public function partition(\Closure $p): array
    {
        $matches = $noMatches = [];

        foreach ($this->elements as $key => $element) {
            if ($p($key, $element)) {
                $matches[$key] = $element;
            } else {
                $noMatches[$key] = $element;
            }
        }

        return [$matches, $noMatches];
    }

    /**
     * Extracts a slice of $length elements starting at position $offset from the Collection.
     *
     * If $length is null it returns all elements from $offset to the end of the Collection.
     * Keys have to be preserved by this method. Calling this method will only return the
     * selected slice and NOT change the elements contained in the collection slice is called on.
     *
     * @param int|null $limit   The maximum number of elements to return, or null for no limit.
     * @param int      $offset  The offset to start from.
     *
     * @return array
     */
    public function take(int $limit = null, int $offset = 0): array
    {
        return array_slice($this->elements, $offset, $limit, true);
    }
}
