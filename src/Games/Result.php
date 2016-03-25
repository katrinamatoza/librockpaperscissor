<?php
/**
 *
 */
namespace Balwan\RockPaperScissor\Games;

use Balwan\RockPaperScissor\Players\Player;
use Balwan\RockPaperScissor\Rules\Rule;

/**
 * Interface 
 * @package Balwan\RockPaperScissor\Games
 */
class Result
{
    /**
     * @var Player
     */
    private $player1;

    /**
     * @var Player
     */
    private $player2;

    /**
     * @var Rule
     */
    private $rule;

    /**
     * Result constructor.
     * @param Player $player1
     * @param Player $player2
     * @param Rule $rule
     */
    public function __construct(Player $player1, Player $player2, Rule $rule)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->rule = $rule;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return sprintf("%s (%s) vs %s (%s) » %s %s %s",
            $this->player1->getName(),
            $this->player1->getPlay(),
            $this->player2->getName(),
            $this->player2->getPlay(),
            $this->rule->getWinner(),
            $this->rule->getOutcome(),
            $this->rule->getLoser()
        );
    }

    /**
     * @return Player
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * @return Player
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * @return Rule
     */
    public function getRule()
    {
        return $this->rule;
    }
}
