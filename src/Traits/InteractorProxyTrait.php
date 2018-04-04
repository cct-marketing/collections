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
    protected abstract function getInteractorProxies(): array;

    /**
     * Dynamically access collection proxies.
     *
     * @param string $proxy
     * @param mixed $args
     *
     * @return CollectionProxy
     *
     * @throws \Exception
     */
    public function __call($proxy, $args = null)
    {
        $possibleProxies = CollectionProxy::$proxies;
        $proxies = array_intersect($possibleProxies, $this->getInteractorProxies());

        if (false === array_key_exists($proxy, $proxies)) {
            throw new \BadMethodCallException("Method [{$proxy}] does not exist on this collection instance.");
        }

        return new CollectionProxy($this, $proxy);
    }
}
