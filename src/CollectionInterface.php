<?php

declare(strict_types=1);

namespace CCT\Component\Collections;

interface CollectionInterface extends \Countable, \IteratorAggregate
{
    /**
     * Sets the internal iterator to the first element in the collection and returns this element.
     *
     * @return mixed
     */
    public function first(): mixed;

    /**
     * Sets the internal iterator to the last element in the collection and returns this element.
     *
     * @return mixed
     */
    public function last(): mixed;

    /**
     * Gets the key/index of the element at the current iterator position.
     *
     * @return int|string
     */
    public function key(): int|string;

    /**
     * Gets the element of the collection at the current iterator position.
     *
     * @return mixed
     */
    public function current(): mixed;

    /**
     * Moves the internal iterator position to the next element and returns this element.
     *
     * @return mixed
     */
    public function next(): mixed;

    /**
     * Checks whether the collection is empty (contains no elements).
     *
     * @return bool TRUE if the collection is empty, FALSE otherwise.
     */
    public function isEmpty(): bool;

    /**
     * Gets a native PHP array representation of the collection.
     *
     * @return array
     */
    public function all(): array;
}
