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
namespace Balwan\RockPaperScissor\Rules;

use ArrayIterator;
use IteratorAggregate;
use Balwan\RockPaperScissor\Rules\Validation\Message;
use Balwan\RockPaperScissor\Rules\Validation\ValidationResult;
use Traversable;

/**
 * Class Rules
 * @package Balwan\RockPaperScissor\Rules
 */
class RuleCollection implements IteratorAggregate
{
    /**
     * The list of rules that is a part of this game type
     * @var array
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
     * @param Rule $rule
     */
    public function add(Rule $rule)
    {
        $winner = mb_strtolower(trim($rule->getWinner()));
        $loser = mb_strtolower(trim($rule->getLoser()));

        $this->rules[md5($winner.$loser)] = $rule;
    }

    /**
     * @param string $winner
     * @param string $loser
     * @return mixed|null
     *
     * TODO Implement Null Object Pattern?
     */
    public function getRule(string $winner, string $loser)
    {
        $winner = mb_strtolower(trim($winner));
        $loser = mb_strtolower(trim($loser));
        $key = md5($winner.$loser);

        if(!isset($this->rules[$key])) {
            return null;
        }

        return $this->rules[$key];
    }

    /**
     * @return array
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
        $validation->addMessage(new Message(sprintf("%d Rules", $validation->totalRules)));

        if(($validation->totalWeapons * 2) == $validation->totalRules) {
            $message = new Message(
                sprintf("Number of weapons (%d) is consistent with the number of rules (%d)",
                $validation->totalWeapons,
                $validation->totalRules)
            );
            $validation->addMessage($message);
        } else {
            $message = new Message(
                sprintf("Number of weapons (%d) is NOT consistent with the number of rules (%d)",
                    $validation->totalWeapons,
                    $validation->totalRules,
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
