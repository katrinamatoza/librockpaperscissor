<?php
/*
 * The MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Balwan\RockPaperScissor\Player;

use ArrayIterator;
use IteratorAggregate;

/**
 * Class PlayerCollection
 * @package Balwan\RockPaperScissor\Player
 */
class PlayerCollection implements IteratorAggregate
{
    /**
     * The list of eligible players that are going to participate in the games.
     * @var array
     */
    private $players = [];

    /**
     * Add a player to the collection. This class implements an Iterator class that allows array-like access to its
     * contents so you can just add items to the collection.
     * @param Player $player
     */
    public function add(Player $player)
    {
        $this->players[] = $player;
    }

    /**
     * @return array
     */
    public function getPlayers() : array
    {
        return $this->players;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->players);
    }
}
