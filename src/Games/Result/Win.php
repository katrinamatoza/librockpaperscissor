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
namespace Balwan\RockPaperScissor\Games\Result;

use Balwan\RockPaperScissor\Players\Player;
use Balwan\RockPaperScissor\Rules\Rule;

/**
 * Class Win
 * @package Balwan\RockPaperScissor\Games\Result
 */
class Win extends AbstractGameResult
{

    /**
     * The rule that led to the final outcome of the game.
     * It should be the rule that "won" the game.
     * @var Rule
     */
    private $rule;

    /**
     * Win constructor.
     * @param Player $player1 A player that participated in a game.
     * @param Player $player2 The other player that participated in a game.
     * @param Rule $rule
     */
    public function __construct(Player $player1, Player $player2, Rule $rule)
    {
        parent::__construct($player1, $player2);
        $this->rule = $rule;
    }

    /**
     * Obtain the rule that "won" a game.
     * @return Rule The rule.
     */
    public function getRule() : Rule
    {
        return $this->rule;
    }
}
