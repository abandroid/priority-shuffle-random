<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\PriorityShuffleRandom\Tests\ShuffleRandomTest;

use Endroid\PriorityShuffleRandom\PriorityShuffleRandom;
use PHPUnit\Framework\TestCase;

class PriorityShuffleRandomTest extends TestCase
{
    public function testPriorityShuffleRandom()
    {
        $values = [];

        $random = new PriorityShuffleRandom();

        for ($i = 0; $i < 10; ++$i) {
            $value = chr(ord('A') + $i);
            $priority = 1;
            switch ($value) {
                case 'B':
                case 'D':
                    $priority = 2;
                    break;
                case 'C':
                    $priority = 3;
                    break;
            }
            $random->add($value, $priority);
            for ($p = 0; $p < $priority; ++$p) {
                $values[] = $value;
            }
        }

        for ($i = 0; $i < 14; ++$i) {
            $value = $random->next();
            $index = array_search($value, $values);
            $this->assertTrue(false !== $index);
            unset($values[$index]);
        }

        $this->assertTrue(0 == count($values));
    }
}
