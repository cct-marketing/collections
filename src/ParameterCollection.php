<?php

declare(strict_types=1);

namespace CCT\Component\Collections;

use CCT\Component\Collections\Traits\ParameterCollectionTrait;

class ParameterCollection extends Collection implements ParameterCollectionInterface
{
    use ParameterCollectionTrait;
}
