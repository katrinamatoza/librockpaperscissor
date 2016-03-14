<?php
/**
 * Created by PhpStorm.
 * User: rvelhote
 * Date: 3/13/16
 * Time: 5:22 PM
 */

namespace RockPaperScissor\Tests;


use RockPaperScissor\Games\Game;
use RockPaperScissor\Players\Player;
use RockPaperScissor\Players\Players;
use RockPaperScissor\Rules\Rule;
use RockPaperScissor\Rules\Rules;
use RockPaperScissor\Rules\Validation\Message;

class GameTest extends \PHPUnit_Framework_TestCase
{
    public function testPaperBeatsRock() {
        $rules = new Rules();

        $player1 = new Player("Ricardo", "Paper");
        $player2 = new Player("Anna", "Rock");

        $rules->addRule(new Rule("Paper", "Rock", "Beats"));
        $rules->addRule(new Rule("Scissor", "Paper", "Beats"));
        $rules->addRule(new Rule("Rock", "Scissor", "Beats"));

        $game = new Game($player1, $player2, $rules);
        $result = $game->result();
        $this->assertEquals($result->__toString(), "Paper Beats Rock");
    }

    public function testPaperRockBeatsScissor() {
        $rules = new Rules();

        $player1 = new Player("Ricardo", "Rock");
        $player2 = new Player("Anna", "Scissor");

        $rules->addRule(new Rule("Paper", "Rock", "Beats"));
        $rules->addRule(new Rule("Scissor", "Paper", "Beats"));
        $rules->addRule(new Rule("Rock", "Scissor", "Beats"));

        $game = new Game($player1, $player2, $rules);
        $result = $game->result();
        $this->assertEquals($result->__toString(), "Rock Beats Scissor");
    }

    public function testPaperScissorBeatsPaper() {
        $rules = new Rules();

        $player1 = new Player("Ricardo", "Scissor");
        $player2 = new Player("Anna", "Paper");

        $rules->addRule(new Rule("Paper", "Rock", "Beats"));
        $rules->addRule(new Rule("Scissor", "Paper", "Beats"));
        $rules->addRule(new Rule("Rock", "Scissor", "Beats"));

        $game = new Game($player1, $player2, $rules);
        $result = $game->result();
        $this->assertEquals($result->__toString(), "Scissor Beats Paper");
    }

    public function testTie() {
        $rules = new Rules();

        $player1 = new Player("Ricardo", "Paper");
        $player2 = new Player("Anna", "Paper");

        $rules->addRule(new Rule("Paper", "Rock", "Beats"));
        $rules->addRule(new Rule("Scissor", "Paper", "Beats"));
        $rules->addRule(new Rule("Rock", "Scissor", "Beats"));

        $game = new Game($player1, $player2, $rules);
        $result = $game->result();
        $this->assertNull($result, "There should be no matching rule");
    }

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
        $this->assertEquals($result->__toString(), "Paper Disproves Spock");
    }

    public function testSuccessValidationWithRockPaperScissors() {
        $rules = new Rules();

        $rules->addRule(new Rule("Paper", "Rock", "Beats"));
        $rules->addRule(new Rule("Scissor", "Paper", "Beats"));
        $rules->addRule(new Rule("Rock", "Scissor", "Beats"));

        $validation = $rules->validate();
        $this->assertEquals(3, $validation->totalWeapons);
        $this->assertCount(0, $validation->messages, "Should have no validation fails");
    }

    public function testFailValidationWithRockPaperScissorsLizardSpock() {
        $rules = new Rules();

        $rules->addRule(new Rule("Scissors", "Paper", "Cuts"));
        $rules->addRule(new Rule("Scissors", "Rock", "Covers"));
        $rules->addRule(new Rule("Rock", "Lizard", "Crushes"));
        $rules->addRule(new Rule("Lizard", "Spock", "Poisons"));
        $rules->addRule(new Rule("Spock", "Scissors", "Smashes"));
        $rules->addRule(new Rule("Scissors", "Lizard", "Decapitates"));
        $rules->addRule(new Rule("Lizard", "Paper", "Eats"));
        $rules->addRule(new Rule("Paper", "Spock", "Disproves"));
        $rules->addRule(new Rule("Spock", "Rock", "Vaporizes"));
        $rules->addRule(new Rule("Rock", "Scissors", "Crushes"));
        $rules->addRule(new Rule("Spock", "Rock", "Vaporizes"));

        $validation = $rules->validate();
        $this->assertEquals(5, $validation->totalWeapons);
        $this->assertCount(2, $validation->messages, "Should have two validation fails");
        $this->assertEquals("Scissors has 3 winning moves so it should have 2 losing moves", $validation->messages[0]->getMessage());
        $this->assertEquals("Paper has 1 winning moves so it should have 2 losing moves", $validation->messages[1]->getMessage());
    }
}
