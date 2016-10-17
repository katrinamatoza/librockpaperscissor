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
namespace Welhott\RockPaperScissor\Game\Result;

use Welhott\RockPaperScissor\Move\Move;

/**
 * Abstract Class AbstractGameResult
 * @package Welhott\RockPaperScissor\Game\Result
 */
abstract class AbstractGameResult
{
    /**
     * The player that won the game (although it can be whatever you desire).
     * @var Move
     */
    protected $player1;

    /**
     * The player that lost the game (although it can be whatever you desire).
     * @var Move
     */
    protected $player2;

    /**
     * You should not instantiate this class directly unless you are introducing a new type of result. For regular
     * cases you should use the Win or Tie classes.
     *
     * @param Move $player1 A player (e.g. the winner)
     * @param Move $player2 Another player (e.g. the loser)
     *
     * @see Tie
     * @see Win
     */
    public function __construct(Move $player1, Move $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }
}
