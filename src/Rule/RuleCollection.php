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
use Balwan\RockPaperScissor\Validation\ValidationMessage;
use Balwan\RockPaperScissor\Validation\ValidationResult;
use Balwan\RockPaperScissor\Validation\ValidationRuleInterface;
use Balwan\RockPaperScissor\Validation\Rule\RuleBalancedWeaponOutcome;
use Balwan\RockPaperScissor\Validation\Rule\RuleTotalWeaponsIsOddNumber;
use Balwan\RockPaperScissor\Validation\Rule\RuleExpectedTotalRules;

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

        $weapons = $this->getWeapons();
        $totalWeapons = count($weapons);
        $totalRules = count($this->rules);

        $validation->addMessage(new ValidationMessage(sprintf("%d Weapons", $totalWeapons)));
        $validation->addMessage(new ValidationMessage(sprintf("%d Rule", $totalRules)));

        $validationRules = [];
        $validationRules[] = new RuleExpectedTotalRules($totalWeapons, $totalRules);
        $validationRules[] = new RuleTotalWeaponsIsOddNumber($totalWeapons);
        $validationRules[] = new RuleBalancedWeaponOutcome($this->rules, $weapons);

        /** @var ValidationRuleInterface $validationRule */
        foreach($validationRules as $validationRule) {
            $output = $validationRule->run();
            if(is_array($output)) {
                $validation->addMessages($output);
            } else {
                $validation->addMessage($output);
            }
        }

        return $validation;
    }
}