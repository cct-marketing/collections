<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Tests;

use CCT\Component\Collections\ArrayCollection;
use CCT\Component\Collections\CollectionInterface;

class ArrayCollectionTest extends AbstractCollectionTest
{
    /**
     * @param array $elements
     *
     * @return CollectionInterface|ArrayCollection
     */
    protected function createCollection(array $elements = []) : CollectionInterface
    {
        return new ArrayCollection($elements);
    }

    public function testAddElement(): void
    {
        $elements = [];
        $collection = $this->createCollection($elements);

        self::assertCount(count($elements), $collection);

        $collection->addElement('element');
        $elements[] = 'element';

        self::assertEquals(count($elements), $collection->count());
        self::assertEquals(end($elements), $collection->last());
    }

    public function testIssetAndUnset(): void
    {
        $collection = $this->createCollection([]);

        self::assertFalse(isset($collection[0]));

        $collection->addElement('testing');
        self::assertTrue(isset($collection[0]));

        unset($collection[0]);
        self::assertFalse(isset($collection[0]));
    }

    public function testArrayAccess(): void
    {
        $collection = $this->createCollection([]);

        $collection[] = 'one';
        $collection[] = 'two';
        $collection[2] = 'three';

        self::assertEquals($collection[0], 'one');
        self::assertEquals($collection[1], 'two');
        self::assertEquals($collection[2], 'three');

        unset($collection[0]);

        self::assertEquals($collection->count(), 2);
    }

    public function testContains(): void
    {
        $collection = $this->createCollection(['element']);

        self::assertTrue($collection->contains('element'));
        self::assertFalse($collection->contains('invalid-element'));
    }

    public function testRemoveElement(): void
    {
        $elements = [];
        $collection = $this->createCollection($elements);

        $collection->addElement('element-x');
        $elements[] = 'element-x';

        self::assertEquals(count($elements), $collection->count());

        $removed = $collection->removeElement('element-x');
        array_pop($elements);

        self::assertCount(count($elements), $collection);
        self::assertTrue($removed);
    }

    public function testRemoveNonExistentElement(): void
    {
        $collection = $this->createCollection([]);

        $removed = $collection->removeElement('element-01');

        self::assertFalse($removed);
    }

    public function testOverrideElements(): void
    {
        $collection = $this->createCollection([]);
        $collection->override(['my-element']);

        self::assertCount(1, $collection);
    }

    public function testInvalidProxyCall()
    {
        $this->expectException(\BadMethodCallException::class);
        $collection = $this->createCollection([]);
        $collection->invalidMethod();
    }
}
