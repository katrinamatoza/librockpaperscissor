<?php

namespace Balwan\RockPaperScissor\Games;

use Balwan\RockPaperScissor\Players\Player;
use Balwan\RockPaperScissor\Players\Players;
use Balwan\RockPaperScissor\Rules\Rule;
use Balwan\RockPaperScissor\Rules\Rules;


/**
 * Class Game
 * @package RockPaperScissor\Interfaces
 */
class Game
{
    /**
     * A list of rules for this game
     * @var Rules;
     */
    private $rules;

    /**
     * @var Player
     */
    private $player1;

    /**
     * @var Player
     */
    private $player2;

    /**
     * Game constructor.
     * @param Players $players
     * @param Rules $rules
     */
    public function __construct(Player $player1, Player $player2, Rules $rules)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->rules = $rules;
    }

    public function getPlayer1() : Player {
        return $this->player1;
    }

    public function getPlayer2() : Player {
        return $this->player2;
    }

    /**
     * Obtains the rules that matched the plays done by the players. In more complex variations of RPS there can be
     * multiple outcomes from the
     * @return array
     */
    public function result()
    {
        $winner = $this->rules->getRule($this->player1->getPlay(), $this->player2->getPlay());
        if(!is_null($winner)) {
            return $winner;
        }

        $winner = $this->rules->getRule($this->player2->getPlay(), $this->player1->getPlay());
        if(!is_null($winner)) {
            return $winner;
        }

        return new Rule($this->player1->getPlay(), $this->player2->getPlay(), "Ties");
    }
}
