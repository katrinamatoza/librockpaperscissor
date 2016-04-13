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
