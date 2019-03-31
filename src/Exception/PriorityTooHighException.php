<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\PriorityShuffleRandom\Exception;

class PriorityTooHighException extends InvalidPriorityException
{
    public function __construct(int $priority, int $priorityMax)
    {
        parent::__construct('Priority should be '.$priorityMax.' max: '.$priority.' given');
    }
}
