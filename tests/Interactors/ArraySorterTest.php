<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Tests\Interactors;

use CCT\Component\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ArraySorterTest extends TestCase
{
    /**
     * @var array
     */
    protected $elements;

    protected function setUp(): void
    {
        $this->elements = [
            'element-01' => 'element-01',
            'element-10' => 'element-10',
            'element-8' => 'element-8',
            'element-5' => 'element-5',
            'element-18' => 'element-18',
            'element-35' => 'element-35',
            'element-25' => 'element-25',
            'alpha' => 'element-80',
            'zelda' => 'element-75'
        ];
    }

    protected function tearDown(): void
    {
        $this->elements = [];
    }

    public function testShuffledElements(): void
    {
        $collection = $this->getArrayCollectionInstance();
        $shuffledCollection = $collection->sorter()->shuffle();

        $this->assertCount($collection->count(), $shuffledCollection->all());
    }

    public function testAscendingOrderByRegularStrategyNotPreservingKeys()
    {
        $collection = $this->getArrayCollectionInstance()->sorter()->sort();
        $elements = $collection->all();

        $this->assertEquals(0, key($elements));
        $this->assertEquals($elements[1], 'element-10');
    }

    public function testDescendingOrderByRegularStrategyNotPreservingKeys()
    {
        $collection = $this->getArrayCollectionInstance()->sorter()->sort(SORT_DESC, SORT_REGULAR);
        $elements = $collection->all();

        $this->assertEquals(0, key($elements));
        $this->assertEquals('element-80', $collection->first());
    }

    public function testAscendingOrderByRegularStrategyPreservingKeys()
    {
        $collection = $this->getArrayCollectionInstance()
            ->sorter()
            ->sort(SORT_ASC, SORT_REGULAR, true)
        ;

        $elements = $collection->all();

        $this->assertEquals('element-01', key($elements));
        $this->assertEquals($elements['element-01'], 'element-01');
    }

    public function testDescendingOrderByRegularStrategyPreservingKeys()
    {
        $collection = $this->getArrayCollectionInstance()
            ->sorter()
            ->sort(SORT_DESC, SORT_REGULAR, true)
        ;

        $elements = $collection->all();

        $this->assertEquals('alpha', key($elements));
        $this->assertEquals('element-80', reset($elements));
    }

    public function testAscendingOrderByNaturalStrategyNotPreservingKeys()
    {
        $collection = $this->getArrayCollectionInstance()->sorter()->sort(SORT_ASC, SORT_NATURAL);
        $elements = $collection->all();

        $this->assertEquals(0, key($elements));
        $this->assertEquals($elements[1], 'element-5');
    }

    public function testAscendingOrderByKeys()
    {
        $collection = $this->getArrayCollectionInstance()->sorter()->sortByKeys(SORT_ASC);
        $elements = $collection->all();

        $this->assertEquals('alpha', key($elements));
        $this->assertEquals('element-80', $collection->first());
    }

    public function testDescendingOrderByKeys()
    {
        $collection = $this->getArrayCollectionInstance()->sorter()->sortByKeys(SORT_DESC);
        $elements = $collection->all();

        $this->assertEquals('zelda', key($elements));
        $this->assertEquals('element-75', $collection->first());
    }

    public function testSortByInvalidOrder()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getArrayCollectionInstance()->sorter()->sort(5000);
    }

    public function testSortByKeysWithInvalidOrder()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getArrayCollectionInstance()->sorter()->sortByKeys(5000);
    }

    protected function getArrayCollectionInstance()
    {
        return new ArrayCollection($this->elements);
    }
}
