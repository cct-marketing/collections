<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Tests\Interactors;

use CCT\Component\Collections\Interactors\ArrayInspector;
use PHPUnit\Framework\TestCase;

class ArrayInspectorTest extends TestCase
{
    /**
     * @param array $elements
     *
     * @return ArrayInspector
     */
    public function createInspector(array $elements): ArrayInspector
    {
        return new ArrayInspector($elements);
    }

    public function testExists(): void
    {
        $inspector = $this->createInspector(['element']);

        self::assertTrue($inspector->exists(function($key, $element) {
            return 'element' === $element;
        }));

        self::assertFalse($inspector->exists(function($key, $element) {
            return 'invalid-element' === $element;
        }));
    }

    public function testIndexOf(): void
    {
        $inspector = $this->createInspector(['element']);

        self::assertEquals(0, $inspector->indexOf('element'));
        self::assertFalse($inspector->indexOf('invalid-element'));
    }
}
