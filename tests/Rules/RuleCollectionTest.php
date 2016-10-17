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
namespace Rule;

use Welhott\RockPaperScissor\Rule\Rule;
use Welhott\RockPaperScissor\Rule\RuleCollection;

/**
 * Class RuleCollectionTest
 * @package Rule
 */
class RuleCollectionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that the Iterator is working correctly.
     * If the foreach loop does not do anything it means that there is something wrong with the implementation.
     */
    public function testIterator()
    {
        $collection = new RuleCollection();
        $collection->add(new Rule("Paper", "Rock", "Covers"));
        $collection->add(new Rule("Scissor", "Paper", "Cuts"));
        $collection->add(new Rule("Rock", "Scissor", "Smashes"));

        $looped = 0;

        foreach($collection as $c)
        {
            if($c) {
                $looped++;
            }
        }

        $this->assertEquals(3, $looped, "There should be 3 rules when looping through the collection.");
    }

    /**
     * Verify that a rule that exists returns a non-null value and verify that a rule that does not exist returns a
     * null value.
     */
    public function testRuleExistsInCollection()
    {
        $collection = new RuleCollection();
        $collection->add(new Rule("Paper", "Rock", "Covers"));
        $collection->add(new Rule("Scissor", "Paper", "Cuts"));
        $collection->add(new Rule("Rock", "Scissor", "Smashes"));

        $this->assertNotNull($collection->getRule("Paper", "Rock"), "The rule 'Paper', 'Rock' should exist.");
        $this->assertNull($collection->getRule("Paper", "Spock"), "The rule 'Paper', 'Spock' should NOT exist.");
    }

    /**
     *
     */
    public function testWeapons()
    {
        $collection = new RuleCollection();
        $collection->add(new Rule("Paper", "Rock", "Covers"));
        $collection->add(new Rule("Scissor", "Paper", "Cuts"));
        $collection->add(new Rule("Rock", "Scissor", "Smashes"));

        $weapons = $collection->getWeapons();
        $this->assertEquals(3, count($weapons), "The total weapons in this collection should be 3.");
        $this->assertArraySubset($weapons, ["Paper", "Scissor", "Rock"]);
    }
}
