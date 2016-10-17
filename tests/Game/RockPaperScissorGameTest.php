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

use Welhott\RockPaperScissor\Game\Game;
use Welhott\RockPaperScissor\Game\Result\Win;
use Welhott\RockPaperScissor\Move\Move;
use Welhott\RockPaperScissor\Rule\Rule;
use Welhott\RockPaperScissor\Rule\RuleCollection;

/**
 * Class RockPaperScissorGameTest.
 * Fully test all variations of a game with Rock Paper Scissor weapons
 * @package RockPaperScissor\Tests
 */
class RockPaperScissorGameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Paper Covers Rock
     */
    public function testPaperBeatsRock()
    {
        $movePlayer1 = new Move("Paper");
        $movePlayer2 = new Move("Rock");

        $game = new Game($movePlayer1, $movePlayer2, static::getRockPaperScissorRules());

        /** @var Win $result */
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Paper Covers Rock");
    }

    /**
     * Rock Smashes Scissor
     */
    public function testRockSmashesScissor()
    {
        $movePlayer1 = new Move("Rock");
        $movePlayer2 = new Move("Scissor");

        $game = new Game($movePlayer1, $movePlayer2, static::getRockPaperScissorRules());

        /** @var Win $result */
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Rock Smashes Scissor");
    }

    /**
     *
     */
    public function testPaperScissorBeatsPaper()
    {
        $movePlayer1 = new Move("Scissor");
        $movePlayer2 = new Move("Paper");

        $game = new Game($movePlayer1, $movePlayer2, static::getRockPaperScissorRules());

        /** @var Win $result */
        $result = $game->result();
        $this->assertEquals($result->getRule()->getText(), "Scissor Cuts Paper");
    }

    /**
     * Generates the rules for the Rock Paper Scissor variation to avoid repeating the rules in the test functions.
     * @return RuleCollection A Rule object with the rules that will be used in the game.
     */
    public static function getRockPaperScissorRules()
    {
        $rules = new RuleCollection();

        $rules->add(new Rule("Paper", "Rock", "Covers"));
        $rules->add(new Rule("Scissor", "Paper", "Cuts"));
        $rules->add(new Rule("Rock", "Scissor", "Smashes"));

        return $rules;
    }
}
