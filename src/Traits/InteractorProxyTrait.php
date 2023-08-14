<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Traits;

use CCT\Component\Collections\CollectionProxy;

trait InteractorProxyTrait
{
    /**
     * Gets the possible proxies for the class.
     *
     * @return array
     */
    abstract protected function getInteractorProxies(): array;

    /**
     * Dynamically access collection proxies.
     *
     * @param string     $proxy
     * @param mixed|null $args
     *
     * @return CollectionProxy
     *
     * @throws \Exception
     */
    public function __call(string $proxy, mixed $args = null): CollectionProxy
    {
        $possibleProxies = CollectionProxy::$proxies;
        $proxies = array_intersect($possibleProxies, $this->getInteractorProxies());

        if (false === array_key_exists($proxy, $proxies)) {
            throw new \BadMethodCallException(sprintf('Method [%s] does not exist on this collection instance.', $proxy));
        }

        return new CollectionProxy($this, $proxy);
    }
}
