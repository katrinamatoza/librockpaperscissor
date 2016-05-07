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

use Balwan\RockPaperScissor\Rule\Rule;
use Balwan\RockPaperScissor\Rule\RuleCollection;
use Balwan\RockPaperScissor\Validation\ValidationMessage;
use Balwan\RockPaperScissor\Validation\ValidationRuleInterface;

/**
 * Class RuleBalancedWeaponOutcome
 * @package Balwan\RockPaperScissor\Rule\Validation
 */
class RuleBalancedWeaponOutcome implements ValidationRuleInterface
{
    /**
     * @var array
     */
    private $rules;

    /**
     * @var array
     */
    private $weapons;

    /**
     * RuleBalancedWeaponOutcome constructor.
     * @param array|RuleCollection $rules
     * @param array $weapons
     */
    public function __construct(array $rules, array $weapons)
    {
        $this->rules = $rules;
        $this->weapons = $weapons;
    }

    /**
     * Run the implementation of the rule. Each rule implementation will return a message. After all rules are ran, if
     * any of them is a FAIL message the validation of the game ruleset (given by the RuleCollection) will have failed.
     * @return array | ValidationMessage An array of messages (or a single Message) with the appropriate status code.
     */
    public function run()
    {
        $messages = [];
        $weapons = array_fill_keys($this->weapons, 0);

        foreach(array_keys($weapons) as $weapon) {
            /** @var Rule $rule */
            foreach($this->rules as $rule) {
                if($rule->getWinner() == $weapon) {
                    $weapons[$weapon]++;
                }

                if($rule->getLoser() == $weapon) {
                    $weapons[$weapon]--;
                }
            }

            if($weapons[$weapon] > 0) {
                $message = new ValidationMessage(sprintf("%s has %d extra wins", $weapon, $weapons[$weapon]), ValidationMessage::FAIL);
            } else if($weapons[$weapon] < 0) {
                $message = new ValidationMessage(sprintf("%s has %d extra losses", $weapon, $weapons[$weapon]), ValidationMessage::FAIL);
            } else {
                $message = new ValidationMessage(sprintf("%s is balanced", $weapon), ValidationMessage::OK);
            }

            $messages[] = $message;
        }

        return $messages;
    }
}