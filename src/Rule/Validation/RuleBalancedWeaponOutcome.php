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
namespace Balwan\RockPaperScissor\Rule\Validation;

use Balwan\RockPaperScissor\Rule\RuleCollection;

/**
 * Class RuleBalancedWeaponOutcome
 * @package Balwan\RockPaperScissor\Rule\Validation
 */
class RuleBalancedWeaponOutcome implements ValidationRuleInterface
{
    /**
     * @var string
     */
    private $name;

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
     * @param string $name
     * @param array|RuleCollection $rules
     * @param array $weapons
     */
    public function __construct(string $name, array $rules, array $weapons)
    {
        $this->name = $name;
        $this->rules = $rules;
        $this->weapons = $weapons;
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
     * @return array | Message An array of messages (or a single Message) with the appropriate status code.
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

            if($weapons[$weapon] === 0) {
                $message = new Message(sprintf("%s is balanced", $weapon), Message::OK);
            } else if($weapons[$weapon] > 0) {
                $message = new Message(sprintf("%s has %d extra wins", $weapon, $weapons[$weapon]), Message::FAIL);
            } else if($weapons[$weapon] < 0) {
                $message = new Message(sprintf("%s has %d extra losses", $weapon, $weapons[$weapon]), Message::FAIL);
            }

            $messages[] = $message;
        }

        return $messages;
    }
}