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
namespace Welhott\RockPaperScissor\Rule;

/**
 * Class RulesTest
 * @package Welhott\RockPaperScissor\Rule
 */
class RulesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Make sure that the weapons array from the ruleset matches the expected data.
     */
    public function testWeapons() {
        $rules = new RuleCollection();

        $rules->add(new Rule("Scissors", "Paper", "Cuts"));
        $rules->add(new Rule("Paper", "Rock", "Covers"));
        $rules->add(new Rule("Rock", "Lizard", "Crushes"));
        $rules->add(new Rule("Lizard", "Spock", "Poisons"));
        $rules->add(new Rule("Spock", "Scissors", "Smashes"));
        $rules->add(new Rule("Scissors", "Lizard", "Decapitates"));
        $rules->add(new Rule("Lizard", "Paper", "Eats"));
        $rules->add(new Rule("Paper", "Spock", "Disproves"));
        $rules->add(new Rule("Spock", "Rock", "Vaporizes"));
        $rules->add(new Rule("Rock", "Scissors", "Crushes"));
        $rules->add(new Rule("Spock", "Rock", "Vaporizes"));

        $expected = [
            "Scissors",
            "Paper",
            "Rock",
            "Lizard",
            "Spock",
        ];

        $this->assertCount(5, $rules->getWeapons(), "The number of weapons should be 5");
        $this->assertEquals($expected, $rules->getWeapons(), "Weapons array should contain: ".implode(",", $expected));
    }

    /**
     * Make sure that a rule that was added and a rule that is later obtained is the same.
     * Also input data with different cases and empty padding and a rule that does not exist (should return null).
     */
    public function testAddRule() {
        $ruleToInsert = new Rule("Scissors", "Paper", "Cuts");

        $rules = new RuleCollection();
        $rules->add($ruleToInsert);

        // Correct casing
        $ruleToObtain = $rules->getRule("Scissors", "Paper");
        $this->assertEquals($ruleToObtain, $ruleToInsert, "[1] The inserted and obtained rule are not the same");

        // Random casing
        $ruleToObtain = $rules->getRule("ScIsSoRs", "PaPeR");
        $this->assertEquals($ruleToObtain, $ruleToInsert, "[2] The inserted and obtained rule are not the same");

        // Random casing and empty padding
        $ruleToObtain = $rules->getRule("       ScIsSoRs      ", "      PaPeR        ");
        $this->assertEquals($ruleToObtain, $ruleToInsert, "[3] The inserted and obtained rule are not the same");

        // Non-existent rule
        $ruleToObtain = $rules->getRule("Rock", "Spock");
        $this->assertNull($ruleToObtain, "Rule should be null because it does not exist");
    }

    /**
     *
     */
    public function testCannotAddEqualWinnerAndLoser()
    {
        $this->expectException("\\Welhott\\RockPaperScissor\\Exception\\InvalidRuleException");
        new Rule("Scissors", "Scissors", "Cuts");
    }

    /**
     *
     */
    public function testGettingTheWinner()
    {
        $rule = new Rule("Rock", "Scissor", "Crushes");
        $this->assertEquals("Rock", $rule->getWinner(), "Winner should be 'Rock'");

        $rule = new Rule("     Rock     ", "Scissor", "Crushes");
        $this->assertEquals("Rock", $rule->getWinner(), "Winner should be 'Rock'. It's not trimmed.");
    }

    /**
     *
     */
    public function testGettingTheLoser()
    {
        $rule = new Rule("Rock", "Scissor", "Crushes");
        $this->assertEquals("Scissor", $rule->getLoser(), "Loser should be 'Scissor'");

        $rule = new Rule("Rock", "   Scissor    ", "Crushes");
        $this->assertEquals("Scissor", $rule->getLoser(), "Loser should be 'Scissor'. It's not trimmed.");
    }

    /**
     *
     */
    public function testGettingTheOutcome()
    {
        $rule = new Rule("Rock", "Scissor", "Crushes");
        $this->assertEquals("Crushes", $rule->getOutcome(), "Outcome should be 'Crushes'");

        $rule = new Rule("Rock", "   Scissor    ", "Crushes");
        $this->assertEquals("Crushes", $rule->getOutcome(), "Outcome should be 'Crushes'. It's not trimmed.");
    }

    /**
     *
     */
    public function testRulesValidation()
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

        $validation = $rules->validate();
        $this->assertTrue($validation->isValid(), "This validation should not have any FAIL messages.");
    }

    /**
     *
     */
    public function testMissingWinner()
    {
        $this->expectException("\\Welhott\\RockPaperScissor\\Exception\\MissingDataException");
        new Rule("", "Scissors", "Crushes");
    }

    /**
     *
     */
    public function testMissingLoser()
    {
        $this->expectException("\\Welhott\\RockPaperScissor\\Exception\\MissingDataException");
        new Rule("Rock", "", "Crushes");
    }

    /**
     *
     */
    public function testMissingOutcome()
    {
        $this->expectException("\\Welhott\\RockPaperScissor\\Exception\\MissingDataException");
        new Rule("Rock", "Scissor", "");
    }

    /**
     *
     */
    public function testRuleNameCleanup()
    {
        $stringToCleanup = "    CLEAned-Up RUle         ";
        $cleanedUpString = Rule::cleanup($stringToCleanup);
        $this->assertEquals("cleaned-up rule", $cleanedUpString, $stringToCleanup." was not cleaned-up correctly");
    }

    /**
     * 
     */
    public function testRuleHashing()
    {
        $winner = "Rock";
        $loser = "Scissor";
        $hashed = Rule::hash($winner, $loser);
        $this->assertEquals("009ad931a6a1867e4a4aa83a52998b58", $hashed, "Rule was not hashed correcly");
    }
}
