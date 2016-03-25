<?php
/**
 *
 */
namespace Balwan\RockPaperScissor\Games;

use Balwan\RockPaperScissor\Games\Result\Tie;
use Balwan\RockPaperScissor\Games\Result\Winner;
use Balwan\RockPaperScissor\Players\Player;
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
     * @param Player $player1
     * @param Player $player2
     * @param Rules $rules
     */
    public function __construct(Player $player1, Player $player2, Rules $rules)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->rules = $rules;
    }

    /**
     * @return Result
     */
    public function result() : Result
    {
        $win = $this->rules->getRule($this->player1->getPlay(), $this->player2->getPlay());
        if(!is_null($win)) {
            return new Result($this->player1, $this->player2, $win);
        }

        $win = $this->rules->getRule($this->player2->getPlay(), $this->player1->getPlay());
        if(!is_null($win)) {
            return new Result($this->player2, $this->player1, $win);
        }

        $tie = new Rule($this->player1->getPlay(), $this->player2->getPlay(), "Ties");
        return new Result($this->player1, $this->player2, $tie);
    }

    /**
     * @return Player
     */
    public function getPlayer1() : Player {
        return $this->player1;
    }

    /**
     * @return Player
     */
    public function getPlayer2() : Player {
        return $this->player2;
    }
}
