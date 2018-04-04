<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Interactors;

interface InteractorInterface
{
    /**
     * Returns all of the stored elements.
     *
     * @return array
     */
    public function all(): array;
}
