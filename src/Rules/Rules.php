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

use Balwan\RockPaperScissor\Rules\Validation\Message;
use Balwan\RockPaperScissor\Rules\Validation\ValidationResult;

/**
 * Class Rules
 * @package Balwan\RockPaperScissor\Rules
 */
class Rules
{
    /**
     * The list of rules that is a part of this game type
     * @var array
     */
    private $rules = [];

    /**
     * @param Rule $rule
     */
    public function addRule(Rule $rule)
    {
        $winner = mb_strtolower(trim($rule->getWinner()));
        $loser = mb_strtolower(trim($rule->getLoser()));

        $this->rules[md5($winner.$loser)] = $rule;
    }

    /**
     * @param string $winner
     * @param string $loser
     * @return mixed|null
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
        $weapons = [];

        /* @var Rule $rule */
        foreach($this->rules as $rule) {
            $weapons[] = $rule->getWinner();
        }

        return array_unique($weapons);
    }

    /**
     * @return ValidationResult The result of the validation of all the rules.
     */
    public function validate() {
        $validation = new ValidationResult();

        /** @var Rule $rule */
        foreach($this->rules as $rule) {
            $winner = $rule->getWinner();

            if(!isset($validation->weapons[$winner])) {
                $validation->weapons[$winner] = 0;
            }

            $validation->weapons[$winner]++;
        }

        $validation->totalWeapons = count($validation->weapons);
        if($validation->totalWeapons % 2 === 0) {
            $message = sprintf("Total weapons is not an odd number. You have %d weapons", $validation->totalWeapons);
            $validation->addMessage(new Message($message, Message::FAIL));
        }

        $losingMoves = (($validation->totalWeapons - 1) / 2);

        foreach($validation->weapons as $weapon => $winningMoves) {
            if($winningMoves != $losingMoves) {
                $message = sprintf("%s has %d winning moves so it should have %d losing moves",
                    $weapon, $winningMoves, $losingMoves);
                $validation->addMessage(new Message($message, Message::FAIL));
            }
        }

        return $validation;
    }
}
