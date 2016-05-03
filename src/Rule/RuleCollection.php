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
namespace Balwan\RockPaperScissor\Rule;

use ArrayIterator;
use IteratorAggregate;
use Balwan\RockPaperScissor\Rule\Validation\Message;
use Balwan\RockPaperScissor\Rule\Validation\ValidationResult;

/**
 * Class RuleCollection
 * @package Balwan\RockPaperScissor\Rule
 */
class RuleCollection implements IteratorAggregate
{
    /**
     * The list of rules that is a part of this game type.
     * @var Rule[]
     */
    private $rules = [];

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->rules);
    }

    /**
     * Add a rule to the collection. A hash based on the winner/loser of this rule is created for faster look-ups.
     * @param Rule $rule The rule that we are adding to the collection.
     */
    public function add(Rule $rule)
    {
        $key = Rule::hash(Rule::cleanup($rule->getWinner()), Rule::cleanup($rule->getLoser()));
        $this->rules[$key] = $rule;
    }

    /**
     * Lookup a rule based on the $winner and the $loser of the rule. When a rule is added an md5 hash of the winner
     * and the loser is created and set as the key. This hash is used to lookup the rule in the array.
     *
     * @param string $winner The weapon that wins this rule.
     * @param string $loser The weapon that loses this rule.
     *
     * @return Rule|null An instance of Balwan\RockPaperScissor\Rule\Rule or null if the rule is not found
     *
     * @see Balwan\RockPaperScissor\Rules\Rule
     *
     * TODO Implement Null Object Pattern?
     */
    public function getRule(string $winner, string $loser)
    {
        $key = Rule::hash(Rule::cleanup($winner), Rule::cleanup($loser));

        if(!isset($this->rules[$key])) {
            return null;
        }

        return $this->rules[$key];
    }

    /**
     * Obtains all the (uniquely) inserted weapons in the collection.
     * @return array An array of strings with all the weapons in the collection.
     */
    public function getWeapons() : array {
        return array_unique(array_values(array_map(function(Rule $r) { return $r->getWinner(); }, $this->rules)));

    }

    /**
     * @return ValidationResult
     */
    public function validate() : ValidationResult {
        $validation = new ValidationResult();

        $validation->totalWeapons = count($this->getWeapons());
        $validation->addMessage(new Message(sprintf("%d Weapons", $validation->totalWeapons)));

        $validation->totalRules = count($this->rules);
        $validation->addMessage(new Message(sprintf("%d Rule", $validation->totalRules)));

        // The number of rules should be
        $validation->expectedTotalRules = (($validation->totalWeapons - 1) / 2) * $validation->totalWeapons;
        if($validation->expectedTotalRules == $validation->totalRules) {
            $message = new Message(
                sprintf("Number of weapons (%d) is consistent with the number of rules (%d).",
                $validation->totalWeapons,
                $validation->totalRules)
            );
            $validation->addMessage($message);
        } else {
            $message = new Message(
                sprintf("Number of weapons (%d) is NOT consistent with the number of rules (%d). %d rules expected."
                    ."according to formula ((totalWeapons - 1) / 2) * totalWeapons)",
                    $validation->totalWeapons,
                    $validation->totalRules,
                    $validation->expectedTotalRules,
                    Message::FAIL)
            );
            $validation->addMessage($message);
        }

        $validation->totalWeaponsIsOddNumber = $validation->totalWeapons % 2 !== 0;

        if($validation->totalWeaponsIsOddNumber) {
            $validation->addMessage(new Message("Total weapons is an odd number"));
        } else {
            $validation->addMessage(new Message("Total weapons is NOT an odd number", Message::FAIL));
        }

        // Verify that each weapon wins and loses the same amount of times.
        // The final total of each array should be zero. Each win increments and each loss decrements.
        $weapons = array_flip($this->getWeapons());
        foreach($weapons as $weapon => $total) {
            $weapons[$weapon] = 0;

            /** @var Rule $rule */
            foreach($this->rules as $rule) {
                if($rule->getWinner() == $weapon) {
                    $weapons[$weapon]++;
                }

                if($rule->getLoser() == $weapon) {
                    $weapons[$weapon]--;
                }
            }

            if($validation->rulesAreBalanced && $weapons[$weapon] !== 0) {
                $validation->rulesAreBalanced = false;
            }

            if($weapons[$weapon] === 0) {
                $message = new Message(sprintf("%s is balanced", $weapon), Message::OK);
                $validation->addMessage($message);
            } else if($weapons[$weapon] > 0) {
                $message = new Message(sprintf("%s has %d extra wins", $weapon, $weapons[$weapon]), Message::FAIL);
                $validation->addMessage($message);
            } else if($weapons[$weapon] < 0) {
                $message = new Message(sprintf("%s has %d extra losses", $weapon, $weapons[$weapon]), Message::FAIL);
                $validation->addMessage($message);
            }
        }

        return $validation;
    }
}
