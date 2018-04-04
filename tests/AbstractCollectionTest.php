<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Tests;

use CCT\Component\Collections\CollectionInterface;
use PHPUnit\Framework\TestCase;

abstract class AbstractCollectionTest extends TestCase
{
    abstract protected function createCollection(array $elements = []) : CollectionInterface;
}
