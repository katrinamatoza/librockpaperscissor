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
namespace Balwan\RockPaperScissor\Game\Result;

use Balwan\RockPaperScissor\Player\Player;

/**
 * Class Tie
 * @package Balwan\RockPaperScissor\Game\Result
 */
class Tie extends AbstractGameResult
{
    /**
     * Instantiates a new result that indicates that the game was a tie. Contrary to the Win class the order of the
     * players is not important but it's recommended to maintain the original order of the players.
     * @param Player $player1 A player that participated in the game
     * @param Player $player2 Another player that participated in the game.
     */
    public function __construct(Player $player1, Player $player2)
    {
        parent::__construct($player1, $player2);
    }

    /**
     * Return the winning player.
     * @return Player
     */
    public function getPlayer1() : Player
    {
        return $this->player1;
    }

    /**
     * Return the losing player.
     * @return Player
     */
    public function getPlayer2() : Player
    {
        return $this->player2;
    }
}