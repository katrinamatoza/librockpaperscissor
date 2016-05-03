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
namespace Balwan\RockPaperScissor\Player;

/**
 * Class PlayerTest
 * @package Player
 */
class PlayerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Confirm that when instantiating a new player there can be no missing or empty data.
     */
    public function testPlayerDataCannotBeEmpty()
    {
        $this->expectException("Balwan\\RockPaperScissor\\Exception\\MissingDataException");
        new Player("", "");
    }

    /**
     * Confirm that the name of the player matches that one that was set.
     */
    public function testName()
    {
        $player = new Player("Joe", "Rock");
        $this->assertEquals("Joe", $player->getName());
    }

    /**
     * Confirm that the name of the play matches the one that was set.
     */
    public function testPlay()
    {
        $player = new Player("Joe", "Rock");
        $this->assertEquals("Rock", $player->getPlay());
    }
}
