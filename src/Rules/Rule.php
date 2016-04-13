<?php

namespace Balwan\RockPaperScissor\Rules;

use Balwan\RockPaperScissor\Exceptions\MissingDataException;
use Exception;

/**
 * Class Rule
 * @package RockPaperScissor\Rules
 */
class Rule
{
    /**
     * The name of the winner of this rule.
     * In a classic Rock Paper Scissor game this could be "Paper".
     * @var string
     */
    private $winner = "";

    /**
     * The name of the loser of this rule.
     * In a classic Rock Paper Scissor game this could be "Rock".
     * @var string
     */
    private $loser = "";

    /**
     * The designation for this outcome.
     * In a classic Rock Paper Scissor game this could be "beats" or "covers"
     * @var string
     */
    private $outcome = "";

    /**
     * Rule constructor.
     * @param string $winner
     * @param string $loser
     * @param string $outcome
     */
    public function __construct(string $winner, string $loser, string $outcome)
    {
        if(mb_strlen(trim($winner)) == 0) {
            throw new MissingDataException("The winner of the rule cannot be empty.");
        }

        if(mb_strlen(trim($loser)) == 0) {
            throw new MissingDataException("The loser of the rule cannot be empty.");
        }

        if(mb_strlen(trim($outcome)) == 0) {
            throw new MissingDataException("The outcome of the rule cannot be empty.");
        }

        $this->winner = trim($winner);
        $this->loser = trim($loser);
        $this->outcome = trim($outcome);
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->winner." ".$this->outcome." ".$this->loser;
    }

    /**
     * @return string
     */
    public function getWinner() : string
    {
        return $this->winner;
    }

    /**
     * @return string
     */
    public function getLoser() : string
    {
        return $this->loser;
    }

    /**
     * @return string
     */
    public function getOutcome() : string
    {
        return $this->outcome;
    }

    public function getText() : string {
        return $this->__toString();
    }
}
