<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Tests\Interactors;

use CCT\Component\Collections\Interactors\ArrayAggregator;
use PHPUnit\Framework\TestCase;

class ArrayAggregatorTest extends TestCase
{
    /**
     * @param array $elements
     *
     * @return ArrayAggregator
     */
    protected function createAggregator(array $elements = []): ArrayAggregator
    {
        return new ArrayAggregator($elements);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     */
    public function testReplace(array $elements): void
    {
        $replacements = [
            'citrus' => ['pineapple'],
            'berries' => ['blueberry']
        ];

        $aggregator = $this->createAggregator($elements);
        $aggregator->replace($replacements);

        $elements = array_replace($elements, $replacements);

        self::assertCount(count($elements['berries']), $aggregator->all()['berries']);
        self::assertCount(count($elements['citrus']), $aggregator->all()['citrus']);
        self::assertArraySubset($elements, $aggregator->all(), true);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     */
    public function testMerge(array $elements): void
    {
        $mergeWith = [
            'citrus' => ['pineapple'],
            'berries' => ['blueberry']
        ];

        $aggregator = $this->createAggregator($elements);
        $aggregator->merge($mergeWith);

        $elements = array_merge($elements, $mergeWith);

        self::assertCount(count($elements), $aggregator->all());
        self::assertArraySubset($elements, $aggregator->all(), true);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     */
    public function testReplaceRecursive(array $elements): void
    {
        $replacements = [
            'citrus' => ['pineapple'],
            'berries' => ['blueberry']
        ];

        $aggregator = $this->createAggregator($elements);
        $aggregator->replaceRecursive($replacements);

        $elements = array_replace_recursive($elements, $replacements);

        self::assertCount(count($elements['berries']), $aggregator->all()['berries']);
        self::assertCount(count($elements['citrus']), $aggregator->all()['citrus']);
        self::assertArraySubset($elements, $aggregator->all(), true);
    }


    /**
     * @param array $elements
     *
     * @dataProvider getElements
     */
    public function testMergeRecursive(array $elements): void
    {
        $replacements = [
            'citrus' => ['pineapple'],
            'berries' => ['blueberry']
        ];

        $aggregator = $this->createAggregator($elements);
        $aggregator->mergeRecursive($replacements);

        $elements = array_merge_recursive($elements, $replacements);

        self::assertCount(count($elements), $aggregator->all());
        self::assertArraySubset($elements, $aggregator->all(), true);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     */
    public function testAppend(array $elements): void
    {
        $aggregator = $this->createAggregator($elements);

        $aggregator->append('element');
        $aggregator->append('element-01', 'element-02');

        array_push($elements, 'element');
        array_push($elements, 'element-01', 'element-02');

        self::assertCount(count($elements), $aggregator->all());
        self::assertArraySubset($elements, $aggregator->all(), true);
    }

    /**
     * @param array $elements
     *
     * @dataProvider getElements
     */
    public function testPrepped(array $elements): void
    {
        $aggregator = $this->createAggregator($elements);

        $aggregator->prepend('element');
        array_unshift($elements, 'element');

        self::assertCount(count($elements), $aggregator->all());
        self::assertArraySubset($elements, $aggregator->all(), true);
    }

    public function getElements(): array
    {
        return [
            [
                [
                    'citrus' => ['orange'],
                    'berries' => ['blackberry', 'raspberry']
                ]
            ]
        ];
    }
}
