<?php
/**
 * 
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
