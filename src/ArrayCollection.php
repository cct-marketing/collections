<?php

declare(strict_types=1);

namespace CCT\Component\Collections;

use CCT\Component\Collections\Interactors\ArrayAggregator;
use CCT\Component\Collections\Interactors\ArraySegregator;
use CCT\Component\Collections\Interactors\ArraySorter;
use CCT\Component\Collections\Interactors\ArrayInspector;
use CCT\Component\Collections\Traits\InteractorProxyTrait;
use CCT\Component\Collections\Traits\ParameterCollectionTrait;

/**
 * @method ArraySorter sorter()
 * @method ArrayInspector inspector()
 * @method ArrayAggregator aggregator()
 * @method ArraySegregator segregator()
 */
class ArrayCollection extends Collection implements ParameterCollectionInterface, ArrayCollectionInterface
{
    use ParameterCollectionTrait;
    use InteractorProxyTrait;

    /**
     * {@inheritdoc}
     */
    protected function getInteractorProxies(): array
    {
        return [
            ArrayAggregator::class,
            ArraySegregator::class,
            ArrayInspector::class,
            ArraySorter::class
        ];
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (!isset($offset)) {
            $this->addElement($value);
            return;
        }

        $this->set($offset, $value);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function addElement($element): void
    {
        $this->elements[] = $element;
    }

    /**
     * {@inheritdoc}
     */
    public function removeElement($element): bool
    {
        $key = $this->inspector()->indexOf($element);

        if ($key === false) {
            return false;
        }

        unset($this->elements[$key]);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function contains($element): bool
    {
        return in_array($element, $this->elements, true);
    }
}
