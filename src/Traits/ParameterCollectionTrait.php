<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Traits;

trait ParameterCollectionTrait
{
    /**
     * @var array
     */
    protected $elements;

    /**
     * {@inheritdoc}
     */
    public function set($key, $value): void
    {
        $this->elements[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        return $this->has($key)
            ? $this->elements[$key]
            : $default
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function keys(): array
    {
        return array_keys($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function values(): array
    {
        return array_values($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        if (false === $this->has($key)) {
            return null;
        }

        $element = $this->elements[$key];
        unset($this->elements[$key]);

        return $element;
    }

    /**
     * {@inheritdoc}
     */
    public function addElements(array $elements): void
    {
        $this->elements = array_replace($this->elements, $elements);
    }

    /**
     * {@inheritdoc}
     */
    public function clear(): void
    {
        $this->elements = [];
    }

    /**
     * {@inheritdoc}
     */
    public function replace(array $elements = []): void
    {
        $this->elements = $elements;
    }

    /**
     * {@inheritdoc}
     */
    public function has($key) : bool
    {
        return isset($this->elements[$key]) || array_key_exists($key, $this->elements);
    }
}
