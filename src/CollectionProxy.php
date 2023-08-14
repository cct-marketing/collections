<?php

declare(strict_types=1);

namespace CCT\Component\Collections;

use CCT\Component\Collections\Interactors\ArrayAggregator;
use CCT\Component\Collections\Interactors\ArrayInspector;
use CCT\Component\Collections\Interactors\ArraySegregator;
use CCT\Component\Collections\Interactors\ArraySorter;
use CCT\Component\Collections\Interactors\InteractorInterface;

class CollectionProxy
{
    /**
     * @var CollectionInterface
     */
    protected CollectionInterface $collection;

    /**
     * @var object
     */
    protected mixed $proxy;

    /**
     * @var array
     */
    public static array $proxies = [
        'sorter' => ArraySorter::class,
        'inspector' => ArrayInspector::class,
        'aggregator' => ArrayAggregator::class,
        'segregator' => ArraySegregator::class,
    ];

    /**
     * ArrayProxy constructor.
     *
     * @param CollectionInterface   $collection
     * @param string                $proxy
     */
    public function __construct(CollectionInterface $collection, string $proxy)
    {
        $this->collection = $collection;
        $this->proxy = new static::$proxies[$proxy]($collection->all());
    }

    /**
     * Proxy a method call onto the specified Interactor.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        $result = $this->proxy->{$method}(...$parameters);

        if (is_array($result)) {
            $this->collection->override($result);

            return $this->collection;
        }

        if ($result instanceof InteractorInterface || null === $result) {
            $this->collection->override($this->proxy->all());

            return $this->collection;
        }

        return $result;
    }
}
