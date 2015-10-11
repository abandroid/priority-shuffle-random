<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\PriorityShuffleRandom\Exception;

class NegativePriorityException extends InvalidPriorityException
{
    /**
     * Class constructor.
     *
     * @param int $priority
     */
    public function __construct($priority)
    {
        parent::__construct('Priority should be positive: '.$priority.' given');
    }
}
