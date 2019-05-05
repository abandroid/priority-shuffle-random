<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\PriorityShuffleRandom;

use Endroid\PriorityShuffleRandom\Exception\NegativePriorityException;

class Prioritizable implements PrioritizableInterface
{
    use PrioritizableTrait;

    public function __construct($value, int $priority = 1)
    {
        if ($priority <= 0) {
            throw new NegativePriorityException($priority);
        }

        $this->value = $value;
        $this->priority = $priority;
    }

    public function __toString(): string
    {
        return $this->value.' ['.$this->priority.']';
    }
}
