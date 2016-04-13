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
namespace RockPaperScissor\Tests;

use Balwan\RockPaperScissor\Games\Game;
use Balwan\RockPaperScissor\Players\Player;
use Balwan\RockPaperScissor\Rules\Rule;
use Balwan\RockPaperScissor\Rules\Rules;

/**
 * Class GameTest.
 *
 * Test the basic game logic to make sure that the results are the expected. This class will test the following
 * game variations: Rock Paper Scissors, Rock Paper Scissors Lizard Spock.
 *
 * @package RockPaperScissor\Tests
 */
class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Paper Covers Rock
     */
    public function testPaperBeatsRock()
    {
        $player1 = new Player("Ricardo V.", "Paper");
        $player2 = new Player("Anna B.", "Rock");

        $game = new Game($player1, $player2, $this->getRockPaperScissorRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Paper Covers Rock");
    }

    /**
     * Rock Smashes Scissor
     */
    public function testRockSmashesScissor()
    {
        $player1 = new Player("Ricardo V.", "Rock");
        $player2 = new Player("Anna B.", "Scissor");

        $game = new Game($player1, $player2, $this->getRockPaperScissorRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Rock Smashes Scissor");
    }

    /**
     *
     */
    public function testPaperScissorBeatsPaper()
    {
        $player1 = new Player("Ricardo V.", "Scissor");
        $player2 = new Player("Anna B.", "Paper");

        $game = new Game($player1, $player2, $this->getRockPaperScissorRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Scissor Cuts Paper");
    }

    /**
     *
     */
    public function testTie()
    {
        $player1 = new Player("Ricardo V.", "Paper");
        $player2 = new Player("Anna B.", "Paper");

        $game = new Game($player1, $player2, $this->getRockPaperScissorRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Paper Ties Paper");
    }

    /**
     *
     */
    public function testPaperDisprovesSpock()
    {
        $player1 = new Player("Ricardo V.", "Paper");
        $player2 = new Player("Anna B.", "Spock");

        $game = new Game($player1, $player2, $this->getRockPaperScissorLizardSpockRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Paper Disproves Spock");
    }

    /**
     *
     */
    public function testSpockSmashesScissors()
    {
        $player1 = new Player("Ricardo V.", "Scissors");
        $player2 = new Player("Anna B.", "Spock");

        $game = new Game($player1, $player2, $this->getRockPaperScissorLizardSpockRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Spock Smashes Scissors");
    }

    /**
     *
     */
    public function testLizardPoisonsSpock()
    {
        $player1 = new Player("Ricardo V.", "Lizard");
        $player2 = new Player("Anna B.", "Spock");

        $game = new Game($player1, $player2, $this->getRockPaperScissorLizardSpockRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Lizard Poisons Spock");
    }

    /**
     *
     */
    public function testRockCrushesLizard()
    {
        $player1 = new Player("Ricardo V.", "Rock");
        $player2 = new Player("Anna B.", "Lizard");

        $game = new Game($player1, $player2, $this->getRockPaperScissorLizardSpockRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Rock Crushes Lizard");
    }

    /**
     *
     */
    public function testSpockVaporizesRock()
    {
        $player1 = new Player("Ricardo V.", "Spock");
        $player2 = new Player("Anna B.", "Rock");

        $game = new Game($player1, $player2, $this->getRockPaperScissorLizardSpockRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Spock Vaporizes Rock");
    }

    /**
     *
     */
    public function testLizardEatsPaper()
    {
        $player1 = new Player("Ricardo V.", "Lizard");
        $player2 = new Player("Anna B.", "Paper");

        $game = new Game($player1, $player2, $this->getRockPaperScissorLizardSpockRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Lizard Eats Paper");
    }

    /**
     *
     */
    public function testScissorDecapitatesLizard()
    {
        $player1 = new Player("Ricardo V.", "Scissors");
        $player2 = new Player("Anna B.", "Lizard");

        $game = new Game($player1, $player2, $this->getRockPaperScissorLizardSpockRules());
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Scissors Decapitates Lizard");
    }

    /**
     * Generates the rules for the Rock Paper Scissor variation to avoid repeating the rules in the test functions.
     * @return Rules A Rules object with the rules that will be used in the game.
     */
    private function getRockPaperScissorRules()
    {
        $rules = new Rules();

        $rules->addRule(new Rule("Paper", "Rock", "Covers"));
        $rules->addRule(new Rule("Scissor", "Paper", "Cuts"));
        $rules->addRule(new Rule("Rock", "Scissor", "Smashes"));

        return $rules;
    }

    /**
     * Generates the rules for the Rock Paper Scissor Lizard Spock variation to avoid repeating the rules in the test
     * functions.
     * @return Rules A Rules object with the rules that will be used in the game.
     */
    private function getRockPaperScissorLizardSpockRules()
    {
        $rules = new Rules();

        $rules->addRule(new Rule("Rock", "Scissors", "Crushes"));
        $rules->addRule(new Rule("Paper", "Rock", "Covers"));
        $rules->addRule(new Rule("Scissors", "Paper", "Cuts"));
        $rules->addRule(new Rule("Rock", "Lizard", "Crushes"));
        $rules->addRule(new Rule("Lizard", "Spock", "Poisons"));
        $rules->addRule(new Rule("Spock", "Scissors", "Smashes"));
        $rules->addRule(new Rule("Scissors", "Lizard", "Decapitates"));
        $rules->addRule(new Rule("Lizard", "Paper", "Eats"));
        $rules->addRule(new Rule("Paper", "Spock", "Disproves"));
        $rules->addRule(new Rule("Spock", "Rock", "Vaporizes"));

        return $rules;
    }
}
