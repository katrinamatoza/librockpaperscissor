<?php
/**
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
use Balwan\RockPaperScissor\Game\Game;
use Balwan\RockPaperScissor\Game\Result\Tie;
use Balwan\RockPaperScissor\Game\Result\Win;
use Balwan\RockPaperScissor\Player\Player;
use Balwan\RockPaperScissor\Rule\RuleCollection;
use Balwan\RockPaperScissor\Rule\Rule;

require "../vendor/autoload.php";

$player1Played = $argv[1];
$availablePlays = ["Rock", "Paper", "Scissor"];

// Players of the gaaaaame!
$player1 = new Player("You", $player1Played);
$player2 = new Player("The Computer", $availablePlays[mt_rand(0, 2)]);

// The ruleset for a regular Rock Paper Scissor game.
$rules = new RuleCollection();
$rules->add(new Rule("Paper", "Rock", "Covers"));
$rules->add(new Rule("Scissor", "Paper", "Cuts"));
$rules->add(new Rule("Rock", "Scissor", "Smashes"));

// You should validate it first to make sure it's all good
$validationResult = $rules->validate();
if($validationResult->isValid()) {
    $game = new Game($player1, $player2, $rules);
    $result = $game->result();

    // A game result can be either a Win or a Tie. A Win contains the players that participated (and their plays) as well
    // as the winning rule. A Tie just contains the players. You can do whatever you want with the data.
    if($result instanceof Tie) {
        /** @var Balwan\RockPaperScissor\Game\Result\Tie $result */
        print "\n» ".$result->getPlayer1()->getName()." tied ".$result->getPlayer2()->getName()."\n";
        print "» ".$result->getPlayer1()->getName(). " played ".$result->getPlayer1()->getPlay()."\n";
        print "» ".$result->getPlayer2()->getName(). " played ".$result->getPlayer2()->getPlay()."\n";
    } else if($result instanceof Win) {
        /** @var Balwan\RockPaperScissor\Game\Result\Win $result */
        print "\n» ".$result->getRule()->getText()."\n================\n";

        // Detailed
        print "» ".$result->getWinner()->getName(). " played ".$result->getWinner()->getPlay()."\n";
        print "» ".$result->getLoser()->getName(). " played ".$result->getLoser()->getPlay()."\n";
        print "» ".$result->getRule()->getWinner()." ".$result->getRule()->getOutcome()." ".$result->getRule()->getLoser()."\n";
        print "» ".$result->getWinner()->getName()." Win(s)!\n\n";
    } else {
        echo "Oops :P";
    }
} else {
    $reflection = new ReflectionClass("\\Balwan\\RockPaperScissor\\Validation\\ValidationMessage");
    $constants = $reflection->getConstants();

    /** @var \Balwan\RockPaperScissor\Validation\ValidationMessage $message */
    foreach($validationResult->getMessages() as $message) {
        $constant = array_search($message->getType(), $constants);
        print "» ".$constant." » ".$message->getMessage()."\n";
    }
}