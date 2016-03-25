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
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPlay()
    {
        return $this->play;
    }

    /**
     * @param string $play
     */
    public function setPlay($play)
    {
        $this->play = $play;
    }
}