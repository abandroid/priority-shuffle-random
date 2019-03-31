<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\PriorityShuffleRandom;

use Endroid\PriorityShuffleRandom\Exception\PriorityNotNumericException;
use Endroid\PriorityShuffleRandom\Exception\PriorityNotPositiveException;

class Prioritizable implements PrioritizableInterface
{
    use PrioritizableTrait;

    public function __construct($value, int $priority = 1)
    {
        if (!is_numeric($priority)) {
            throw new PriorityNotNumericException($priority);
        }

        if ($priority <= 0) {
            throw new PriorityNotPositiveException($priority);
        }

        $this->value = $value;
        $this->priority = $priority;
    }

    public function __toString(): string
    {
        return $this->value.' ['.$this->priority.']';
    }
}
