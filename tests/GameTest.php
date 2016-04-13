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

use Balwan\RockPaperScissor\DataProvider\Provider\GooglePlus;
use Balwan\RockPaperScissor\Games\Game;
use Balwan\RockPaperScissor\Players\Player;
use Balwan\RockPaperScissor\Rules\Rule;
use Balwan\RockPaperScissor\Rules\Rules;
use Dotenv\Dotenv;

/**
 * Class GameTest
 * @package RockPaperScissor\Tests
 */
class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testPaperBeatsRock() {
        $rules = new Rules();

        $player1 = new Player("Ricardo", "Paper");
        $player2 = new Player("Anna", "Rock");

        $rules->addRule(new Rule("Paper", "Rock", "Beats"));
        $rules->addRule(new Rule("Scissor", "Paper", "Beats"));
        $rules->addRule(new Rule("Rock", "Scissor", "Beats"));

        $game = new Game($player1, $player2, $rules);
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Paper Beats Rock");
    }

    /**
     *
     */
    public function testPaperRockBeatsScissor() {
        $rules = new Rules();

        $player1 = new Player("Ricardo", "Rock");
        $player2 = new Player("Anna", "Scissor");

        $rules->addRule(new Rule("Paper", "Rock", "Beats"));
        $rules->addRule(new Rule("Scissor", "Paper", "Beats"));
        $rules->addRule(new Rule("Rock", "Scissor", "Beats"));

        $game = new Game($player1, $player2, $rules);
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Rock Beats Scissor");
    }

    /**
     *
     */
    public function testPaperScissorBeatsPaper() {
        $rules = new Rules();

        $player1 = new Player("Ricardo", "Scissor");
        $player2 = new Player("Anna", "Paper");

        $rules->addRule(new Rule("Paper", "Rock", "Beats"));
        $rules->addRule(new Rule("Scissor", "Paper", "Beats"));
        $rules->addRule(new Rule("Rock", "Scissor", "Beats"));

        $game = new Game($player1, $player2, $rules);
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Scissor Beats Paper");
    }

    /**
     *
     */
    public function testTie() {
        $rules = new Rules();

        $player1 = new Player("Ricardo", "Paper");
        $player2 = new Player("Anna", "Paper");

        $rules->addRule(new Rule("Paper", "Rock", "Beats"));
        $rules->addRule(new Rule("Scissor", "Paper", "Beats"));
        $rules->addRule(new Rule("Rock", "Scissor", "Beats"));

        $game = new Game($player1, $player2, $rules);
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Paper Ties Paper");
    }

    /**
     *
     */
    public function testSpock() {
        $rules = new Rules();

        $player1 = new Player("Ricardo", "Paper");
        $player2 = new Player("Anna", "Spock");

        $rules->addRule(new Rule("Scissors", "Paper", "Cuts"));
        $rules->addRule(new Rule("Paper", "Rock", "Covers"));
        $rules->addRule(new Rule("Rock", "Lizard", "Crushes"));
        $rules->addRule(new Rule("Lizard", "Spock", "Poisons"));
        $rules->addRule(new Rule("Spock", "Scissors", "Smashes"));
        $rules->addRule(new Rule("Scissors", "Lizard", "Decapitates"));
        $rules->addRule(new Rule("Lizard", "Paper", "Eats"));
        $rules->addRule(new Rule("Paper", "Spock", "Disproves"));
        $rules->addRule(new Rule("Spock", "Rock", "Vaporizes"));
        $rules->addRule(new Rule("Rock", "Scissors", "Crushes"));
        $rules->addRule(new Rule("Spock", "Rock", "Vaporizes"));

        $game = new Game($player1, $player2, $rules);
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Paper Disproves Spock");
    }

//    public function testSuccessValidationWithRockPaperScissors() {
//        $rules = new Rules();
//
//        $rules->addRule(new Rule("Paper", "Rock", "Beats"));
//        $rules->addRule(new Rule("Scissor", "Paper", "Beats"));
//        $rules->addRule(new Rule("Rock", "Scissor", "Beats"));
//
//        $validation = $rules->validate();
//        $this->assertEquals(3, $validation->totalWeapons);
//        $this->assertCount(0, $validation->messages, "Should have no validation fails");
//    }
//
//    public function testFailValidationWithRockPaperScissorsLizardSpock() {
//        $rules = new Rules();
//
//        $rules->addRule(new Rule("Scissors", "Paper", "Cuts"));
//        $rules->addRule(new Rule("Scissors", "Rock", "Covers"));
//        $rules->addRule(new Rule("Rock", "Lizard", "Crushes"));
//        $rules->addRule(new Rule("Lizard", "Spock", "Poisons"));
//        $rules->addRule(new Rule("Spock", "Scissors", "Smashes"));
//        $rules->addRule(new Rule("Scissors", "Lizard", "Decapitates"));
//        $rules->addRule(new Rule("Lizard", "Paper", "Eats"));
//        $rules->addRule(new Rule("Paper", "Spock", "Disproves"));
//        $rules->addRule(new Rule("Spock", "Rock", "Vaporizes"));
//        $rules->addRule(new Rule("Rock", "Scissors", "Crushes"));
//        $rules->addRule(new Rule("Spock", "Rock", "Vaporizes"));
//
//        $validation = $rules->validate();
//        $this->assertEquals(5, $validation->totalWeapons);
//        $this->assertCount(2, $validation->messages, "Should have two validation fails");
//        $this->assertEquals("Scissors has 3 winning moves so it should have 2 losing moves", $validation->messages[0]->getMessage());
//        $this->assertEquals("Paper has 1 winning moves so it should have 2 losing moves", $validation->messages[1]->getMessage());
//    }
//
    public function testGooglePlus() {
        $environment = new Dotenv(__DIR__);
        $environment->load();

        $provider = new GooglePlus(getenv("GOOGLE_PLUS_API_KEY"));
        $players = [];

        $rules = new Rules();
        $rules->addRule(new Rule("Scissors", "Paper", "Cuts"));
        $rules->addRule(new Rule("Paper", "Rock", "Covers"));
        $rules->addRule(new Rule("Rock", "Lizard", "Crushes"));
        $rules->addRule(new Rule("Lizard", "Spock", "Poisons"));
        $rules->addRule(new Rule("Spock", "Scissors", "Smashes"));
        $rules->addRule(new Rule("Scissors", "Lizard", "Decapitates"));
        $rules->addRule(new Rule("Lizard", "Paper", "Eats"));
        $rules->addRule(new Rule("Paper", "Spock", "Disproves"));
        $rules->addRule(new Rule("Spock", "Rock", "Vaporizes"));
        $rules->addRule(new Rule("Rock", "Scissors", "Crushes"));
        $rules->addRule(new Rule("Spock", "Rock", "Vaporizes"));

        $weapons = $rules->getWeapons();

        foreach($weapons as $weapon) {
            $players = array_merge($players, $provider->get(strtolower($weapon)));
        }

        shuffle($players);

        for($i = 0; $i < count($players); $i += 2) {
            $game = new Game($players[$i], $players[$i + 1], $rules);
            $result = $game->result();

            echo "\n";
            echo $result;
        }
    }
}
