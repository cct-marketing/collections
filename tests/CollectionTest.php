<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Tests;

use CCT\Component\Collections\Collection;
use CCT\Component\Collections\CollectionInterface;

class CollectionTest extends AbstractCollectionTest
{
    /**
     * @param array $elements
     *
     * @return CollectionInterface|Collection
     */
    protected function createCollection(array $elements = []) : CollectionInterface
    {
        return new Collection($elements);
    }

    /**
     * @var array $elements
     *
     * @dataProvider provideDifferentElements
     */
    public function testAll(array $elements): void
    {
        $collection = $this->createCollection($elements);

        self::assertSame($elements, $collection->all());
    }

    /**
     * @var array $elements
     *
     * @dataProvider provideDifferentElements
     */
    public function testFirst(array $elements): void
    {
        $collection = $this->createCollection($elements);

        self::assertSame(reset($elements), $collection->first());
    }

    /**
     * @var array $elements
     *
     * @dataProvider provideDifferentElements
     */
    public function testLast(array $elements): void
    {
        $collection = $this->createCollection($elements);

        self::assertSame(end($elements), $collection->last());
    }

    /**
     * @var array $elements
     *
     * @dataProvider provideDifferentElements
     */
    public function testKey(array $elements): void
    {
        $collection = $this->createCollection($elements);

        self::assertSame(key($elements), $collection->key());

        next($elements);
        $collection->next();

        self::assertSame(key($elements), $collection->key());
    }

    /**
     * @var array $elements
     *
     * @dataProvider provideDifferentElements
     */
    public function testNext(array $elements): void
    {
        $collection = $this->createCollection($elements);

        while (true) {
            $collectionNext = $collection->next();
            $arrayNext = next($elements);

            if (!$collectionNext || !$arrayNext) {
                break;
            }

            self::assertSame($arrayNext, $collectionNext, 'Returned value of ArrayCollection::next() and next() not match');
            self::assertSame(key($elements), $collection->key(), 'Keys not match');
            self::assertSame(current($elements), $collection->current(), 'Current values not match');
        }
    }

    /**
     * @var array $elements
     *
     * @dataProvider provideDifferentElements
     */
    public function testCurrent(array $elements): void
    {
        $collection = $this->createCollection($elements);

        self::assertSame(current($elements), $collection->current());

        next($elements);
        $collection->next();

        self::assertSame(current($elements), $collection->current());
    }

    /**
     * @var array $elements
     *
     * @dataProvider provideDifferentElements
     */
    public function testCount(array $elements): void
    {
        $collection = $this->createCollection($elements);

        self::assertCount(count($elements), $collection);
        self::assertEquals(count($elements), $collection->count());
    }

    public function testEmpty(): void
    {
        $collection = $this->createCollection([1, 2, 3]);
        self::assertFalse($collection->isEmpty(), 'Not empty collection');

        $collection = $this->createCollection([]);
        self::assertTrue($collection->isEmpty(), 'Empty collection');
    }

    /**
     * @var array $elements
     *
     * @dataProvider provideDifferentElements
     */
    public function testIterator($elements): void
    {
        $collection = $this->createCollection($elements);

        $iterations = 0;
        foreach ($collection->getIterator() as $key => $item) {
            self::assertSame($elements[$key], $item, 'Item ' . $key . ' not match');
            ++$iterations;
        }

        self::assertEquals(count($elements), $iterations, 'Number of iterations not match');
    }

    public function testToString(): void
    {
        $collection = new Collection([]);
        $collectionString = (string)$collection;

        self::assertTrue(is_string($collectionString));
    }

    public function provideDifferentElements(): array
    {
        return [
            'indexed'     => [[1, 2, 3, 4, 5]],
            'associative' => [['A' => 'a', 'B' => 'b', 'C' => 'c']],
            'mixed'       => [['A' => 'a', 1, 'B' => 'b', 2, 3]],
        ];
    }
}
