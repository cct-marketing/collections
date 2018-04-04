<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Tests;

use CCT\Component\Collections\ArrayCollection;
use CCT\Component\Collections\CollectionInterface;
use CCT\Component\Collections\CollectionProxy;
use PHPUnit\Framework\TestCase;

class CollectionProxyTest extends TestCase
{
    public function createProxy(array $elements, string $proxy)
    {
        $collection = new ArrayCollection($elements);

        return new CollectionProxy($collection, $proxy);
    }

    public function testNewCollectionResponse()
    {
        $collectionProxy = $this->createProxy([1, 2],'sorter');
        $collection = $collectionProxy->shuffle();

        self::assertInstanceOf(CollectionInterface::class, $collection);
    }

    public function testVoidProxyResponse()
    {
        $collectionProxy = $this->createProxy([1, 2],'segregator');
        $collection = $collectionProxy->pop();

        self::assertInstanceOf(CollectionInterface::class, $collection);
    }

    public function testNonArrayAndNotNullResponse()
    {
        $collectionProxy = $this->createProxy([1, 2],'inspector');
        $response = $collectionProxy->indexOf(1);

        self::assertEquals(0, $response);
    }
}
