<?php

namespace Balwan\RockPaperScissor\Rules;

use Exception;
use Balwan\RockPaperScissor\Rules\Validation\Message;
use Balwan\RockPaperScissor\Rules\Validation\ValidationResult;

class Rules
{
    /**
     * The list of rules that is a part of this game type
     * @var array
     */
    private $rules = [];

    /**
     * Adds a rule to the list of
     * @param string $winner
     * @param string $loser
     * @param string $outcome
     * @throws Exception
     */
    public function addRule(Rule $rule)
    {
        $this->rules[md5($rule->getWinner().$rule->getLoser())] = $rule;
    }

    /**
     * @param string $winner
     * @param string $loser
     * @return Rule
     * @throws Exception
     */
    public function getRule(string $winner, string $loser) {
        $key = md5($winner.$loser);

        if(!isset($this->rules[$key])) {
            return null;
        }

        return $this->rules[$key];
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
