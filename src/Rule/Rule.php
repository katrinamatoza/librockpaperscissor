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
namespace Balwan\RockPaperScissor\Rule;

use Balwan\RockPaperScissor\Exception\InvalidRuleException;
use Balwan\RockPaperScissor\Exception\MissingDataException;

/**
 * Class Rule
 * @package RockPaperScissor\Rule
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
     * In a classic Rock Paper Scissors for the combination Paper vs Rock would be "covers".
     * @var string
     */
    private $outcome = "";

    /**
     * Rule constructor.
     *
     * @param string $winner The winner of this rule.
     * @param string $loser The loser of this rule.
     * @param string $outcome The outcome of this rule.
     *
     * @throws MissingDataException If any of the data is an empty string (after being trimmed).
     * @throws InvalidRuleException If the winner if the same as the loser after cleanup.
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

        if(static::cleanup($winner) === static::cleanup($loser)) {
            throw new InvalidRuleException("You have specified the same weapon for the winner and the loser.");
        }

        $this->winner = trim($winner);
        $this->loser = trim($loser);
        $this->outcome = trim($outcome);
    }

    /**
     * Cleanup the weapon name. Basically a trim() + mb_strtolower. This is used by the library when a new Rule is
     * being inserted in the collection. It may be used by you, the developer, if you want to use the collection a
     * regular array.
     *
     * This step is actually optional because you can just as well hash the weapon name as is however it's a fail-safe
     * in case you wrongfully insert weapon names with different cases or extra spaces in the beginning or end.
     *
     * @param string $weapon The name of the weapon being cleaned-up.
     * @return string A clean weapon name, ready for action!
     */
    public static function cleanup(string $weapon) : string
    {
        return mb_strtolower(trim($weapon));
    }

    /**
     * Hash the weapon pair passed in order to insert it in the Rule Collection array.
     * @param string $winner The weapon that wins the game.
     * @param string $loser The weapon that loses the game.
     * @return string An md5 hash of the weapon pair passed as a parameter.
     */
    public static function hash(string $winner, string $loser) : string
    {
        return md5($winner.$loser);
    }

    /**
     * Obtain the winner of this rule.
     * @return string The winner weapon of this rule e.g. "Paper".
     */
    public function getWinner() : string
    {
        return $this->winner;
    }

    /**
     * Obtain the loser of this rule.
     * @return string The loser weapon of this rule e.g. "Rock".
     */
    public function getLoser() : string
    {
        return $this->loser;
    }

    /**
     * Obtain the outcome of this rule.
     * @return string The outcome of this rule e.g. "Covers"
     */
    public function getOutcome() : string
    {
        return $this->outcome;
    }

    /**
     * Obtain a string that represents the rule in the following format: "%winner[space]%outcome[space]%loser".
     * @return string A string representation of this rule.
     */
    public function getText() : string {
        return sprintf("%s %s %s", $this->winner, $this->outcome, $this->loser);
    }
}
