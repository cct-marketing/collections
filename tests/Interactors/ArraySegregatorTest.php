<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Tests\Interactors;

use CCT\Component\Collections\Interactors\ArraySegregator;
use PHPUnit\Framework\TestCase;

class ArraySegregatorTest extends TestCase
{
    public function createSegregator(array $elements)
    {
        return new ArraySegregator($elements);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     *
     * @return void
     */
    public function testPop(array $elements): void
    {
        $segregator = $this->createSegregator($elements);

        array_pop($elements);
        $segregator->pop();

        $collection = $segregator->all();

        self::assertCount(count($elements), $collection);
        self::assertArraySubset($elements, $collection, true);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     *
     * @return void
     */
    public function testShift(array $elements): void
    {
        $segregator = $this->createSegregator($elements);

        array_shift($elements);
        $segregator->shift();
        $collection = $segregator->all();

        self::assertCount(count($elements), $collection);
        self::assertArraySubset($elements, $collection, true);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     *
     * @return void
     */
    public function testEach(array $elements): void
    {
        $segregator = $this->createSegregator($elements);
        $callable = function($value) {
            if ($value != 'element-01') {
                return '-';
            }

            return $value;
        };

        $collection = $segregator->map($callable);
        $elements = array_map($callable, $elements);

        self::assertCount(count($elements), $collection);
        self::assertArraySubset($elements, $collection, true);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     *
     * @return void
     */
    public function testFilter(array $elements): void
    {
        $segregator = $this->createSegregator($elements);
        $callable = function($value) {
            return $value === 'element-01';
        };

        $elements = array_filter($elements, $callable);
        $collection = $segregator->filter($callable);

        self::assertArrayHasKey('key-1', $elements);
        self::assertArrayHasKey('key-1', $collection);
        self::assertCount(count($elements), $collection);
        self::assertArraySubset($elements, $collection, true);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     *
     * @return void
     */
    public function testPartition(array $elements): void
    {
        $segregator = $this->createSegregator($elements);
        $partition = $segregator->partition(function ($k, $e) {
            return $e === 'element-02';
        });

        self::assertArrayHasKey('key-2', $partition[0]);
        self::assertArrayHasKey('key-1', $partition[1]);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     *
     * @return void
     */
    public function testTake(array $elements): void
    {
        $segregator = $this->createSegregator($elements);

        $collection = $segregator->take(1, 1);
        $elements = array_slice($elements, 1, 1);

        self::assertCount(count($elements), $collection);
        self::assertEquals(current($elements), current($collection));
        self::assertEquals('element-02', current($collection));
    }

    public function getElements(): array
    {
        return [
            [
                [
                    'key-1' => 'element-01',
                    'key-2' => 'element-02',
                    'key-3' => 'element-03',
                ]
            ],
        ];
    }
}
