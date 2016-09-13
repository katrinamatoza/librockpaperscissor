<?php
/**
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
namespace RockPaperScissor\Tests\Game;

use Balwan\RockPaperScissor\Game\Game;
use Balwan\RockPaperScissor\Game\Result\Win;
use Balwan\RockPaperScissor\Player\Player;
use Balwan\RockPaperScissor\Rule\Rule;
use Balwan\RockPaperScissor\Rule\RuleCollection;

/**
 * Class RockPaperScissorGameTest.
 * Fully test all variations of a game with Rock Paper Scissor Lizard Spock weapons
 * @package RockPaperScissor\Tests
 */
class RockPaperScissorLizardSpockGameTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testPaperDisprovesSpock()
    {
        $player1 = new Player("Paper");
        $player2 = new Player("Spock");

        $game = new Game($player1, $player2, static::getRockPaperScissorLizardSpockRules());

        /** @var Win $result */
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Paper Disproves Spock");
    }

    /**
     *
     */
    public function testSpockSmashesScissors()
    {
        $player1 = new Player("Scissors");
        $player2 = new Player("Spock");

        $game = new Game($player1, $player2, static::getRockPaperScissorLizardSpockRules());

        /** @var Win $result */
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Spock Smashes Scissors");
    }

    /**
     *
     */
    public function testLizardPoisonsSpock()
    {
        $player1 = new Player("Lizard");
        $player2 = new Player("Spock");

        $game = new Game($player1, $player2, static::getRockPaperScissorLizardSpockRules());

        /** @var Win $result */
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Lizard Poisons Spock");
    }

    /**
     *
     */
    public function testRockCrushesLizard()
    {
        $player1 = new Player("Rock");
        $player2 = new Player("Lizard");

        $game = new Game($player1, $player2, static::getRockPaperScissorLizardSpockRules());

        /** @var Win $result */
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Rock Crushes Lizard");
    }

    /**
     *
     */
    public function testSpockVaporizesRock()
    {
        $player1 = new Player("Spock");
        $player2 = new Player("Rock");

        $game = new Game($player1, $player2, static::getRockPaperScissorLizardSpockRules());

        /** @var Win $result */
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Spock Vaporizes Rock");
    }

    /**
     *
     */
    public function testLizardEatsPaper()
    {
        $player1 = new Player("Lizard");
        $player2 = new Player("Paper");

        $game = new Game($player1, $player2, static::getRockPaperScissorLizardSpockRules());

        /** @var Win $result */
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Lizard Eats Paper");
    }

    /**
     *
     */
    public function testScissorDecapitatesLizard()
    {
        $player1 = new Player("Scissors");
        $player2 = new Player("Lizard");

        $game = new Game($player1, $player2, static::getRockPaperScissorLizardSpockRules());

        /** @var Win $result */
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Scissors Decapitates Lizard");
    }


    /**
     * Generates the rules for the Rock Paper Scissor Lizard Spock variation to avoid repeating the rules in the test
     * functions.
     * @return RuleCollection A Rule object with the rules that will be used in the game.
     */
    public static function getRockPaperScissorLizardSpockRules()
    {
        $rules = new RuleCollection();

        $rules->add(new Rule("Rock", "Scissors", "Crushes"));
        $rules->add(new Rule("Paper", "Rock", "Covers"));
        $rules->add(new Rule("Scissors", "Paper", "Cuts"));
        $rules->add(new Rule("Rock", "Lizard", "Crushes"));
        $rules->add(new Rule("Lizard", "Spock", "Poisons"));
        $rules->add(new Rule("Spock", "Scissors", "Smashes"));
        $rules->add(new Rule("Scissors", "Lizard", "Decapitates"));
        $rules->add(new Rule("Lizard", "Paper", "Eats"));
        $rules->add(new Rule("Paper", "Spock", "Disproves"));
        $rules->add(new Rule("Spock", "Rock", "Vaporizes"));

        return $rules;
    }
}