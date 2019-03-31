<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\PriorityShuffleRandom;

trait PrioritizableTrait
{
    private $value;
    private $priority;

    public function getValue()
    {
        return $this->value;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }
}
