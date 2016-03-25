<?php
/*
 * The MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Balwan\RockPaperScissor\Players;

use Balwan\RockPaperScissor\Exceptions\MissingDataException;

/**
 * This class represents a single player that is participating in a game.
 * @package Balwan\RockPaperScissor\Players
 */
class Player {
    /**
     * The name of the player.
     * @var string
     */
    private $name;

    /**
     * The play that the player used (e.g. Rock, Paper or Scissor).
     * @var string
     */
    private $play;

    /**
     * Instantiate a player that will be participating in a game.
     * @param string $name The name of the player.
     * @param string $play The play/move that the player will perform in the game.
     */
    public function __construct(string $name, string $play)
    {
        if(mb_strlen($name) == 0) {
            throw new MissingDataException("The player's name cannot be empty!");
        }

        if(mb_strlen($name) == 0) {
            throw new MissingDataException("The player's play cannot be empty!");
        }

        $this->name = $name;
        $this->play = $play;
    }

    /**
     * Obtain the name of the player.
     * @return string The name of the player.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Obtain the play that the player is using in this game.
     * @return string The name of the play that was played by the player.
     */
    public function getPlay()
    {
        return $this->play;
    }
}
