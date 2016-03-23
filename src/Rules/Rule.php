<?php

namespace Balwan\RockPaperScissor\Rules;

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
    private $winner;

    /**
     * The name of the loser of this rule.
     * In a classic Rock Paper Scissor game this could be "Rock".
     * @var string
     */
    private $loser;

    /**
     * The designation for this outcome.
     * In a classic Rock Paper Scissor game this could be "beats" or "covers"
     * @var string
     */
    private $outcome;

    /**
     * Rule constructor.
     * @param string $winner
     * @param string $loser
     * @param string $outcome
     */
    public function __construct(string $winner, string $loser, string $outcome)
    {
        if($winner == $loser) {
            throw new Exception("Winner and Loser cannot be the same");
        }

        $this->winner = trim($winner);
        $this->loser = trim($loser);
        $this->outcome = trim($outcome);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->winner." ".$this->outcome." ".$this->loser;
    }

    /**
     * @return string
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @return string
     */
    public function getLoser()
    {
        return $this->loser;
    }

    /**
     * @return string
     */
    public function getOutcome()
    {
        return $this->outcome;
    }
}
