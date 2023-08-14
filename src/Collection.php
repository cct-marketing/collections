<?php

declare(strict_types=1);

namespace CCT\Component\Collections;

class Collection implements CollectionInterface
{
    /**
     * An array containing the entries of this collection.
     */
    protected array $elements;

    /**
     * Initializes a new ArrayCollection.
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->elements;
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function first(): mixed
    {
        return reset($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function last(): mixed
    {
        return end($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function key(): int|string
    {
        return key($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function next(): mixed
    {
        return next($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function current(): mixed
    {
        return current($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->elements);
    }

    /**
     * Returns a string representation of this object.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . '@' . spl_object_hash($this);
    }
}
