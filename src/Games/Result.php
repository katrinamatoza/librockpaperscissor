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
namespace Balwan\RockPaperScissor\Games;

use Balwan\RockPaperScissor\Players\Player;
use Balwan\RockPaperScissor\Rules\Rule;

/**
 * Interface 
 * @package Balwan\RockPaperScissor\Games
 */
class Result
{
    /**
     * @var Player
     */
    private $player1;

    /**
     * @var Player
     */
    private $player2;

    /**
     * @var Rule
     */
    private $rule;

    /**
     * Result constructor.
     * @param Player $player1
     * @param Player $player2
     * @param Rule $rule
     */
    public function __construct(Player $player1, Player $player2, Rule $rule)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->rule = $rule;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return sprintf("%s (%s) vs %s (%s) » %s %s %s",
            $this->player1->getName(),
            $this->player1->getPlay(),
            $this->player2->getName(),
            $this->player2->getPlay(),
            $this->rule->getWinner(),
            $this->rule->getOutcome(),
            $this->rule->getLoser()
        );
    }

    /**
     * @return Player
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * @return Player
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * @return Rule
     */
    public function getRule()
    {
        return $this->rule;
    }
}
