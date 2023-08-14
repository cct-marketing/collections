<?php

declare(strict_types=1);

namespace CCT\Component\Collections;

interface ArrayCollectionInterface extends \ArrayAccess
{
    /**
     * Checks whether an element is contained in the collection.
     * This is an O(n) operation, where n is the size of the collection.
     *
     * @param mixed $element The element to search for.
     *
     * @return bool TRUE if the collection contains the element, FALSE otherwise.
     */
    public function contains(mixed $element): bool;

    /**
     * Removes the specified element from the collection, if it is found.
     *
     * @param mixed $element The element to remove.
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeElement(mixed $element): bool;

    /**
     * Adds a new element in the end of collection.
     *
     * @param mixed $element
     *
     * @return void
     */
    public function addElement(mixed $element): void;

    /**
     * Overrides the elements of the array.
     *
     * @param array $elements
     *
     * @return ArrayCollectionInterface
     */
    public function override(array $elements): self;
}
