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
namespace Welhott\RockPaperScissor\Rules\Validation;
use Welhott\RockPaperScissor\Rule\Rule;
use Welhott\RockPaperScissor\Rule\RuleCollection;

/**
 * Class ValidationResultTest
 * @package Rules\Validation
 * @todo Improve testing of the validation class to include tests to make specific rules fail and pass.
 */
class ValidationResultTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationResult()
    {
        $rules = new RuleCollection();
        $rules->add(new Rule("Paper", "Rock", "Covers"));
        $rules->add(new Rule("Scissor", "Paper", "Cuts"));
        $rules->add(new Rule("Rock", "Scissor", "Smashes"));

        $validationResult = $rules->validate();
        $messages = $validationResult->getMessages();

        $this->assertEquals(7, count($messages), "With this ruleset, the validation, should return 0 messages.");
        $this->assertTrue($validationResult->isValid(), "The ruleset should be valid");
    }

    public function testValidationResultFails()
    {
        $rules = new RuleCollection();
        $rules->add(new Rule("Paper", "Rock", "Covers"));
        $rules->add(new Rule("Scissor", "Paper", "Cuts"));
        $rules->add(new Rule("Rock", "Paper", "Smashes"));
        $rules->add(new Rule("Spock", "Lizard", "Spits"));

        $validationResult = $rules->validate();
        $this->assertFalse($validationResult->isValid(), "The ruleset should not be valid");
    }
}
