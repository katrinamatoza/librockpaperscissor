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
namespace Players;

use Welhott\RockPaperScissor\Move\Move;
use Welhott\RockPaperScissor\Move\MoveCollection;

/**
 * Class PlayerCollectionTest
 * @package Players
 */
class PlayerCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * 
     */
    public function testCollectionCount()
    {
        $collection = new MoveCollection();
        $collection->add(new Move("Rock"));
        $collection->add(new Move("Scissor"));
        $this->assertEquals(2, count($collection), "There should be 2 players in the collection");
    }

    /**
     * Test that the Iterator is working correctly.
     * If the foreach loop does not do anything it means that there is something wrong with the implementation.
     */
    public function testLoop()
    {
        $collection = new MoveCollection();
        $collection->add(new Move("Rock"));
        $collection->add(new Move("Scissor"));

        $looped = 0;

        foreach($collection as $c)
        {
            if($c) {
                $looped++;
            }
        }

        $this->assertEquals(2, $looped, "There should be 2 players when looping through the collection.");
    }
}
