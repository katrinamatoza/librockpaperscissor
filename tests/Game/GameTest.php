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

use Balwan\RockPaperScissor\Game\Game;
use Balwan\RockPaperScissor\Game\Result\Tie;
use Balwan\RockPaperScissor\Game\Result\Win;
use Balwan\RockPaperScissor\Player\Player;
use RockPaperScissor\Tests\Game\RockPaperScissorGameTest;
use RockPaperScissor\Tests\Game\RockPaperScissorLizardSpockGameTest;

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
     *
     */
    public function testTie()
    {
        $className = "\\Balwan\\RockPaperScissor\\Game\\Result\\Tie";

        $player1 = new Player("Ricardo V.", "Paper");
        $player2 = new Player("Anna B.", "Paper");

        $game = new Game($player1, $player2, RockPaperScissorGameTest::getRockPaperScissorRules());

        /** @var Tie $result */
        $result = $game->result();

        $this->assertInstanceOf($className, $result, "Result is not a Tie instance");
        $this->assertEquals($player1, $result->getPlayer1(), "Player 1 in the Tie instance is the original object");
        $this->assertEquals($player2, $result->getPlayer2(), "Player 1 in the Tie instance is the original object");
    }

    /**
     * Confirm the the result of a game is a Win and that the player objects that are in the Win instance are the
     * correct ones.
     */
    public function testWin()
    {
        $className = "\\Balwan\\RockPaperScissor\\Game\\Result\\Win";

        $player1 = new Player("Ricardo V.", "Paper");
        $player2 = new Player("Anna B.", "Rock");

        $game = new Game($player1, $player2, RockPaperScissorGameTest::getRockPaperScissorRules());

        /** @var Win $result */
        $result = $game->result();

        $this->assertInstanceOf($className, $result, "Result is not a Win instance");
        $this->assertEquals($player1, $result->getWinner(), "The winner is incorrect in this game result.");
        $this->assertEquals($player2, $result->getLoser(), "The loser is incorrect in this game result.");
    }


    /**
     *
     */
    public function testGettingPlayers()
    {
        $player1 = new Player("Ricardo V.", "Scissors");
        $player2 = new Player("Anna B.", "Lizard");
        $game = new Game($player1, $player2, RockPaperScissorLizardSpockGameTest::getRockPaperScissorLizardSpockRules());

        $this->assertEquals($player1, $game->getPlayer1(), "Player1 is invalid or the original changed.");
        $this->assertEquals($player2, $game->getPlayer2(), "Player2 is invalid or the original changed.");
    }

    /**
     *
     */
    public function testGettingRules()
    {
        $player1 = new Player("Ricardo V.", "Scissors");
        $player2 = new Player("Anna B.", "Lizard");
        $rules = RockPaperScissorLizardSpockGameTest::getRockPaperScissorLizardSpockRules();
        $game = new Game($player1, $player2, $rules);

        $this->assertEquals($rules, $game->getRules(), "The object that was passed in the constructor is incorrect.");
    }
}
