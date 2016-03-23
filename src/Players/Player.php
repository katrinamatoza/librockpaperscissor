<?php

namespace Balwan\RockPaperScissor\Players;

class Player {
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $play;

    /**
     * Player constructor.
     * @param string $name
     * @param string $play
     */
    public function __construct(string $name, string $play)
    {
        $this->name = $name;
        $this->play = $play;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPlay()
    {
        return $this->play;
    }
}