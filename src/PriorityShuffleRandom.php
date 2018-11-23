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
    /**
     * @var Prioritizable[]
     */
    protected $items;

    /**
     * @var array
     */
    protected $itemsByPriority;

    /**
     * @var bool
     */
    protected $validated;

    /**
     * Creates a new instance.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->add($item);
        }

        $this->validated = false;
    }

    /**
     * Adds an item.
     *
     * @param mixed $item
     * @param int   $priority
     *
     * @return $this
     */
    public function add($item, $priority = 1)
    {
        if (!$item instanceof Prioritizable) {
            $item = new Prioritizable($item, $priority);
        }

        $this->itemsByPriority[$item->getPriority()][] = $item;

        $this->validated = false;

        return $this;
    }

    /**
     * Validates all items.
     */
    protected function validate()
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

    /**
     * Shuffles all items.
     */
    public function shuffle()
    {
        $this->validate();

        $shuffledItems = [];

        foreach ($this->itemsByPriority as $priority => $items) {
            shuffle($items);
            foreach ($items as $item) {
                $chunkSize = ceil(count($shuffledItems) / $priority);
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

    /**
     * Returns the next value.
     *
     * @return mixed
     */
    public function next()
    {
        if (!is_array($this->items) || 0 === count($this->items)) {
            $this->shuffle();
        }

        $item = array_shift($this->items);

        return $item->getValue();
    }
}
