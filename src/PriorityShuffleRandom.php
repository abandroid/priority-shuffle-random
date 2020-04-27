<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\PriorityShuffleRandom;

use Endroid\PriorityShuffleRandom\Exception\PriorityTooHighException;

class PriorityShuffleRandom
{
    private $items;

    /** @var array[int, int] */
    private $itemsByPriority;

    /** @var bool */
    private $validated = false;

    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function add($item, $priority = 1)
    {
        if (!$item instanceof Prioritizable) {
            $item = new Prioritizable($item, $priority);
        }

        $this->itemsByPriority[$item->getPriority()][] = $item;

        $this->validated = false;

        return $this;
    }

    protected function validate(): void
    {
        if ($this->validated) {
            return;
        }

        $priorityMax = 0;

        foreach ($this->itemsByPriority as $priority => $items) {
            if (1 != $priority && 0 != $priorityMax && $priority > $priorityMax) {
                throw new PriorityTooHighException($priority, $priorityMax);
            }
            $priorityMax += $priority * count($items);
        }

        $this->validated = true;
    }

    public function shuffle(): void
    {
        $this->validate();

        $shuffledItems = [];

        foreach ($this->itemsByPriority as $priority => $items) {
            shuffle($items);
            foreach ($items as $item) {
                $chunkSize = intval(ceil(count($shuffledItems) / $priority));
                for ($i = 0; $i < $priority; ++$i) {
                    $minInsertIndex = ($chunkSize + 1) * $i;
                    $maxInsertIndex = max(0, $minInsertIndex + $chunkSize - 1);
                    $insertIndex = mt_rand($minInsertIndex, $maxInsertIndex);
                    array_splice($shuffledItems, $insertIndex, 0, [$item]);
                }
            }
        }

        $this->items = $shuffledItems;
    }

    public function next()
    {
        if (!is_array($this->items) || 0 === count($this->items)) {
            $this->shuffle();
        }

        $item = array_shift($this->items);

        if (!$item instanceof PrioritizableInterface) {
            throw new \Exception('Unable to retrieve next prioritizable');
        }

        return $item->getValue();
    }
}
