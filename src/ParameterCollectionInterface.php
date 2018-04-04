<?php

declare(strict_types=1);

namespace CCT\Component\Collections;

interface ParameterCollectionInterface
{
    /**
     * Sets an element in the collection at the specified key/index.
     *
     * @param string|int $key   The key/index of the element to set.
     * @param mixed      $value The element to set.
     *
     * @return void
     */
    public function set($key, $value): void;

    /**
     * Gets the element at the specified key/index.
     *
     * @param string|int $key The key/index of the element to retrieve.
     * @param mixed $default The default value if the parameter key does not exist
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Adds the elements to the collection using array_replace.
     *
     * @param array $elements
     *
     * @return void
     */
    public function addElements(array $elements): void;

    /**
     * Checks if the array has the specific key.
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function has($key): bool;

    /**
     * Clears the collection, removing all elements.
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Removes the element at the specified index from the collection.
     *
     * @param string|int $key The kex/index of the element to remove.
     *
     * @return mixed The removed element or NULL, if the collection did not contain the element.
     */
    public function remove($key);

    /**
     * Replaces the current parameters by a new set.
     *
     * @param array $elements
     */
    public function replace(array $elements): void;

    /**
     * Gets all keys/indices of the collection.
     *
     * @return array The keys/indices of the collection, in the order of the corresponding
     *               elements in the collection.
     */
    public function keys(): array;

    /**
     * Gets all values of the collection.
     *
     * @return array The values of all elements in the collection, in the order they
     *               appear in the collection.
     */
    public function values(): array;
}
