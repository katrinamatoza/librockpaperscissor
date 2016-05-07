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
namespace Balwan\RockPaperScissor\Validation\Rule;

use Balwan\RockPaperScissor\Validation\ValidationMessage;
use Balwan\RockPaperScissor\Validation\ValidationRuleInterface;

/**
 * Class RuleExpectedTotalRules
 * @package Balwan\RockPaperScissor\Rule\Validation\Rule
 */
class RuleExpectedTotalRules implements ValidationRuleInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $totalWeapons;

    /**
     * @var int
     */
    private $totalRules;

    /**
     * RuleExpectedTotalRules constructor.
     * @param string $name The name of the rule we are evaluating
     * @param int $totalWeapons The total weapons that are exist in the ruleset
     * @param int $totalRules The total rules that exist in the ruleset
     */
    public function __construct(string $name, int $totalWeapons, int $totalRules)
    {
        $this->name = $name;
        $this->totalWeapons = $totalWeapons;
        $this->totalRules = $totalRules;
    }

    /**
     * Obtain the name of the validation rule.
     * @return string The name of the rule.
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Run the implementation of the rule. Each rule implementation will return a message. After all rules are ran, if
     * any of them is a FAIL message the validation of the game ruleset (given by the RuleCollection) will have failed.
     * @return array | ValidationMessage An array of messages (or a single Message) with the appropriate status code.
     */
    public function run()
    {
        $expected = (($this->totalWeapons - 1) / 2) * $this->totalWeapons;

        if($expected == $this->totalRules) {
            $tpl = "Number of weapons (%d) is consistent with the number of rules (%d).";
            return new ValidationMessage(sprintf($tpl, $this->totalWeapons, $this->totalRules), ValidationMessage::OK);
        }

        $tpl = "Number of weapons (%d) is NOT consistent with the number of rules (%d). %d rules expected "
            ."according to formula ((totalWeapons - 1) / 2) * totalWeapons)";
        return new ValidationMessage(sprintf($tpl, $this->totalWeapons, $this->totalRules, $expected), ValidationMessage::FAIL);
    }
}
