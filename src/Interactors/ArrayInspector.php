<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Interactors;

class ArrayInspector extends AbstractInteractor
{
    /**
     * Gets the index/key of a given element. The comparison of two elements is strict,
     * that means not only the value but also the type must match.
     * For objects this means reference equality.
     *
     * @param mixed $element The element to search for.
     *
     * @return int|string|bool The key/index of the element or FALSE if the element was not found.
     */
    public function indexOf(mixed $element): bool|int|string
    {
        return array_search($element, $this->elements, true);
    }

    /**
     * Tests for the existence of an element that satisfies the given predicate.
     *
     * @param \Closure $p The predicate.
     *
     * @return bool TRUE if the predicate is TRUE for at least one element, FALSE otherwise.
     */
    public function exists(\Closure $p): bool
    {
        foreach ($this->elements as $key => $element) {
            if ($p($key, $element)) {
                return true;
            }
        }

        return false;
    }
}
