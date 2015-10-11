<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\PriorityShuffleRandom\Exception;

class PriorityTooHighException extends InvalidPriorityException
{
    /**
     * Class constructor.
     *
     * @param int $priority
     * @param int $priorityMax
     */
    public function __construct($priority, $priorityMax)
    {
        parent::__construct('Priority should be '.$priorityMax.' max: '.$priority.' given');
    }
}
