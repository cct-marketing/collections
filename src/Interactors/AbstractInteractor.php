<?php

declare(strict_types=1);

namespace CCT\Component\Collections\Interactors;

abstract class AbstractInteractor implements InteractorInterface
{
    /**
     * @var array
     */
    protected $elements;

    /**
     * AbstractInteractor constructor.
     *
     * @param array $elements
     */
    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->elements;
    }
}
