<?php

namespace RockPaperScissor\Players;

class Players
{
    /**
     * @var array
     */
    private $players = [];

    public function add(Player $player)
    {
        $this->players[] = $player;
    }

    public function getPlayers()
    {
        return $this->players;
    }
}