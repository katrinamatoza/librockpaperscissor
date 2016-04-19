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

use Balwan\RockPaperScissor\Games\Result\AbstractGameResult;
use Balwan\RockPaperScissor\Games\Result\Win;
use Balwan\RockPaperScissor\Games\Result\Tie;
use Balwan\RockPaperScissor\Players\Player;
use Balwan\RockPaperScissor\Rules\RuleCollection;

/**
 * This class defines a game between two players and the set of rules that is to be applied.
 * @package Balwan\RockPaperScissor\Games
 */
class Game
{
    /**
     * The list of rules that are applicable in this game.
     * @var RuleCollection
     */
    private $rules;

    /**
     * The first player of this game.
     * @var Player
     */
    private $player1;

    /**
     * The second player of this game.
     * @var Player
     */
    private $player2;

    /**
     * Instantiate an RPS-style game.
     * @param Player $player1 The first player of this game.
     * @param Player $player2 The second player of this game.
     * @param RuleCollection $rules The set of rules that are applicable to this game.
     */
    public function __construct(Player $player1, Player $player2, RuleCollection $rules)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->rules = $rules;
    }

    /**
     * Pit the players against each other and see who emerges victorious.
     * The choices made by the players are tested against the rules of the game and a Result is issued that contains 
     * the players that participated and the winning rule.
     * In case of a tie a special rule is created by this method and returned alongside the result.
     * @return AbstractGameResult The result of this game.
     */
    public function result() : AbstractGameResult
    {
        $player1Wins = $this->rules->getRule($this->player1->getPlay(), $this->player2->getPlay());
        if(!is_null($player1Wins)) {
            return new Win($this->player1, $this->player2, $player1Wins);
        }

        $player2Wins = $this->rules->getRule($this->player2->getPlay(), $this->player1->getPlay());
        if(!is_null($player2Wins)) {
            return new Win($this->player2, $this->player1, $player2Wins);
        }

        return new Tie($this->player1, $this->player2, "Ties");
    }

    /**
     * Obtain the Player1 of this game.
     * @return Player
     */
    public function getPlayer1() : Player {
        return $this->player1;
    }

    /**
     * Obtain the Player2 of this game.
     * @return Player
     */
    public function getPlayer2() : Player {
        return $this->player2;
    }

    /**
     * Obtain the rule-set that is applicable to this game.
     * @return RuleCollection A rules object with all the rules for this game.
     */
    public function getRules() : RuleCollection {
        return $this->rules;
    }
}
