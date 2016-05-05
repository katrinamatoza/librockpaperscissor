# Rock Paper Scissors PHP Library
> Create games with rules based on Rock Paper Scissors with any combination you desire. Validation rules will make sure that you are on the right track to creating a valid game.

This project is mostly an exercise in fun for me. After seeing a [101 moves](http://www.umop.com/rps101.htm) RPS-style game I thought it would be cool to recreate that game in PHP. I decided, however, that I would create a library instead. Maybe the game will come soon.

There are still a lot of improvements to make but I believe that, in general, it's doing its job.

## Installing / Getting started

There is a Dockerfile that I use to develop the library. I just use it to quickly setup a PHP enviroment and then download PHPUnit and Composer into the container. I also install SSH so I can do remote debugging and remote unit testing with PHPStorm. This Dockerfile is missing a lot of things including configuring PHP for development (e.g. display_errors). It's on my TODOs.

For now, just build the container and run it.
```bash
docker build -t librps .
docker run -ti [-p 22] -v YOUR_PATH:CONTAINER_PATH librps
```

## Developing

The first step of course is to clone the repo. Then you should update the composer libraries and then run the testsuite.

```shell
git clone https://github.com/rvelhote/librockpaperscissor.git
cd librockpaperscissor
composer update
phpunit
```

If you don't have Composer or PHPUnit installed please refer to their respective websites for current installation instructions.

## Using the Library

Create games with rules base on Rock Paper Scissors, Rock Paper Scissors Lizard Spock and whatever your heart desires.

An amazing man named David C. Lovelace created the most shocking RPS games I have seen. You can [check them out](http://www.umop.com/rps.htm) and create a super cool game with them. These rules are quite complex (well, not always)... if only there was a PHP library to help people implement this thing. Oh wait.

For implementation details you can refer to the testsuite which will show some examples. Anyway, here is the gist of it. For the classic Rock Paper Scissors game you need:

* 2 Players
* 3 Rules
* Each rule must beat 50% of the other rules and must be beaten by the other 50% of rules (excluding itself). This is why the number of weapons is always an odd number.
* Each player must choose a weapon to play
* Finally, you must determine a winner

```PHP
// Players of the gaaaaame!
$player1 = new Player("Ricardo V.", "Paper");
$player2 = new Player("Anna B.", "Rock");

// The rule set
$ruleCollection = new RuleCollection();
$ruleCollection->add(new Rule("Paper", "Rock", "Covers"));
$ruleCollection->add(new Rule("Scissor", "Paper", "Cuts"));
$ruleCollection->add(new Rule("Rock", "Scissor", "Smashes"));

// You should validate it first to make sure it's all good
$validationResult = $ruleCollection->validate();
if($validationResult->isValid()) {
    $game = new Game($player1, $player2, $rules);
    $gameResult = $game->result();

    // A game result can be either a Win or a Tie. A Win contains the players that participated (and their plays) as well
    // as the winning rule. A Tie just contains the players. You can do whatever you want with the data.
    if($gameResult instanceof Tie) {
        // FIXME $gameResult should be able to return the players
        echo $game->getPlayer1()." tied ".$game->getPlayer2();
    } else {
        // This should output "Paper Covers Rock"
        echo $game->getRule()->getText();

        // Alternatively
        echo $game->getRule()->getWinner()." ".$this->getRule()->getOutcome()." ".$this->getRule()->getLoser();
    }
} else {
    // Ooops. Let's see why.
    var_dump($validationResult->getMessages());
}
```

## Contributing
You are welcome to suggest improvements to the library and to contribute yourself :)

## Licensing
The code in this project is licensed under MIT license.