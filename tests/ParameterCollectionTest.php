<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Tests;

use CCT\Component\Collections\CollectionInterface;
use CCT\Component\Collections\ParameterCollection;

class ParameterCollectionTest extends AbstractCollectionTest
{
    /**
     * @param array $elements
     *
     * @return CollectionInterface|ParameterCollection
     */
    protected function createCollection(array $elements = []) : CollectionInterface
    {
        return new ParameterCollection($elements);
    }

    /**
     * @dataProvider getBaseCollection
     *
     * @param array $elements
     */
    public function testIfTheCollectionHasSpecificKeys(array $elements): void
    {
        $collection = $this->createCollection($elements);

        self::assertTrue($collection->has('key-2'));
        self::assertFalse($collection->has('key-3'));
    }

    /**
     * @dataProvider getBaseCollection
     *
     * @param array $elements
     */
    public function testRemoveElementsFromTheCollectionByKeys(array $elements): void
    {
        $collection = $this->createCollection($elements);
        $collection->addElements(['new-key' => 'new-element']);

        self::assertEquals('new-element', $collection->remove('new-key'));
        self::assertNull($collection->remove('invalid-key'));
    }

    /**
     * @dataProvider getBaseCollection
     *
     * @param array $elements
     */
    public function testGetKeys(array $elements): void
    {
        $collection = $this->createCollection($elements);
        $collectionKeys = $collection->keys();
        $keys = array_keys($elements);

        self::assertCount(count($keys), $collectionKeys);
        foreach ($keys as $key => $value) {
            $this->assertSame($value, $collectionKeys[$key]);
        }
    }

    /**
     * @dataProvider getBaseCollection
     *
     * @param array $elements
     */
    public function testGetValues(array $elements): void
    {
        $collection = $this->createCollection($elements);
        $collectionValues = $collection->values();
        $values = array_values($elements);

        self::assertCount(count($values), $collectionValues);
        foreach ($values as $key => $value) {
            $this->assertSame($value, $collectionValues[$key]);
        }
    }

    /**
     * @dataProvider getBaseCollection
     *
     * @param array $elements
     */
    public function testClear(array $elements): void
    {
        $collection = $this->createCollection($elements);
        $collection->clear();

        self::assertEmpty($collection->all());
    }

    /**
     * @dataProvider getBaseCollection
     *
     * @param array $elements
     */
    public function testReplace(array $elements): void
    {
        $newElements = ['element-03', 'element-04'];
        $collection = $this->createCollection($elements);
        $collection->replace($newElements);

        self::assertCount(count($newElements), $collection);
        foreach ($newElements as $key => $value) {
            $this->assertSame($value, $collection->all()[$key]);
        }
    }

    /**
     * @dataProvider getBaseCollection
     *
     * @param array $elements
     */
    public function testAddElements(array $elements): void
    {
        $newElements = ['element-03', 'element-04'];

        $collection = $this->createCollection($elements);
        $collection->addElements($newElements);

        $elements = array_replace($elements, $newElements);

        self::assertCount(count($elements), $collection);
        foreach ($elements as $key => $value) {
            $this->assertSame($value, $collection->all()[$key]);
        }
    }

    /**
     * @dataProvider getBaseCollection
     *
     * @param array $elements
     */
    public function testSetGet(array $elements): void
    {
        $collection = $this->createCollection($elements);
        $collection->set('key-1', 'element-03');

        self::assertEquals('element-03', $collection->get('key-1'));
        self::assertNull($collection->get('invalid-key', null));
        self::assertEquals('default-value', $collection->get('invalid-key', 'default-value'));
    }

    public function getBaseCollection()
    {
        return [
            [
                [
                    'key-1' => 'element-01',
                    'key-2' => 'element-02'
                ]
            ]
        ];
    }
}
