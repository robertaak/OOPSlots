<?php

namespace App;

class Game
{
    private int $credits = 0;

    private array $symbolsPerLine = [
        3 => 5.00,
        4 => 10.00,
        5 => 100.00
    ];

    private int $lineCount = 5;
    private int $k;
    private int $bet;

    public function getCredits(): int
    {
        return $this->credits;
    }

    public function setBet(): void
    {
        $this->bet = readline();
    }

    public function getBet(): int
    {
        return $this->bet;
    }

    public function setK(): void
    {
        $this->k = $this->lineCount * $this->bet;
    }

    public function getK(): int
    {
        return $this->k;
    }

    public function gotThree(): void
    {
        echo 'You got 3 in a line! Prize: '. $this->symbolsPerLine[3] * $this->k . PHP_EOL;
        $this->credits += $this->symbolsPerLine[3] * $this->k;
    }

    public function gotFour(): void
    {
        echo 'You got 4 in a line! Prize: '. $this->symbolsPerLine[4] * $this->k . PHP_EOL;
        $this->credits += $this->symbolsPerLine[4] * $this->k;
    }

    public function gotFive(): void
    {
        echo 'You got 5 in a line! Prize: '. $this->symbolsPerLine[5] * $this->k . PHP_EOL;
        $this->credits += $this->symbolsPerLine[5] * $this->k;
    }

    public function gotNothing(): void
    {
        $this->credits -= $this->k;
    }

    public function start(): void
    {
        $player = new Player();
        $board = new Board();

        $board->displayBoard($board);

        echo 'enter your balance/ ';
        $player->setWallet();

        echo 'enter money into the machine/ ';
        $amount = (int)readline();

        while ($amount > $player->getWallet() || !is_numeric($amount)) {
            echo 'enter valid amount/ ';
            $amount = (int)readline();
        }

        $player->subtractFromWallet($amount);
        $this->credits += $amount;
        echo 'your balance/ ';
        echo $this->getCredits() . PHP_EOL;

        echo 'place your bet/ ';
        $this->setBet();
        while  ($this->getBet() > $this->getCredits()) {
            echo 'place valid bet/ ';
            $this->setBet();
        }
        echo 'coefficient/ ';
        $this->setK();
        echo $this->getK(). PHP_EOL;

        echo 'press 1 to play or 2 to quit/ ';
        $player->choice();

        while ($this->getCredits() > $this->getK()) {
            if ($player->getChoice() === 2) {
                $player->addToWallet($this->getCredits());
                echo "returning {$this->getCredits()}/ ";
                die('goodbye'  .PHP_EOL);
            } else {
                $board->fillTheBoard();
                $board->displayBoard($board);

                if (($board->getBoard()[0] == $board->getBoard()[1] && $board->getBoard()[1] == $board->getBoard()[2] && $board->getBoard()[2] == $board->getBoard()[3] && $board->getBoard()[3] == $board->getBoard()[4])
                || ($board->getBoard()[0] == $board->getBoard()[6] && $board->getBoard()[6] == $board->getBoard()[12] && $board->getBoard()[12] == $board->getBoard()[8] && $board->getBoard()[8] == $board->getBoard()[4])
                || ($board->getBoard()[10] == $board->getBoard()[6] && $board->getBoard()[6] == $board->getBoard()[2] && $board->getBoard()[2] == $board->getBoard()[8] && $board->getBoard()[8] == $board->getBoard()[14])
                || ($board->getBoard()[5] == $board->getBoard()[6] && $board->getBoard()[6] == $board->getBoard()[7] && $board->getBoard()[7] == $board->getBoard()[8] && $board->getBoard()[8] == $board->getBoard()[9])
                || ($board->getBoard()[10] == $board->getBoard()[11] && $board->getBoard()[11] == $board->getBoard()[12] && $board->getBoard()[12] == $board->getBoard()[13] && $board->getBoard()[13] == $board->getBoard()[14])) {
                    $this->gotFive();
                }

                elseif (($board->getBoard()[0] == $board->getBoard()[1] && $board->getBoard()[1] == $board->getBoard()[2] && $board->getBoard()[2] == $board->getBoard()[3])
                    || ($board->getBoard()[0] == $board->getBoard()[6] && $board->getBoard()[6] == $board->getBoard()[12] && $board->getBoard()[12] == $board->getBoard()[8])
                    || ($board->getBoard()[10] == $board->getBoard()[6] && $board->getBoard()[6] == $board->getBoard()[2] && $board->getBoard()[2] == $board->getBoard()[8])
                    || ($board->getBoard()[5] == $board->getBoard()[6] && $board->getBoard()[6] == $board->getBoard()[7] && $board->getBoard()[7] == $board->getBoard()[8])
                    || ($board->getBoard()[10] == $board->getBoard()[11] && $board->getBoard()[11] == $board->getBoard()[12] && $board->getBoard()[12] == $board->getBoard()[13])) {
                    $this->gotFour();
                }

                elseif (($board->getBoard()[0] == $board->getBoard()[1] && $board->getBoard()[1] == $board->getBoard()[2])
                    || ($board->getBoard()[0] == $board->getBoard()[6] && $board->getBoard()[6] == $board->getBoard()[12])
                    || ($board->getBoard()[10] == $board->getBoard()[6] && $board->getBoard()[6] == $board->getBoard()[2])
                    || ($board->getBoard()[5] == $board->getBoard()[6] && $board->getBoard()[6] == $board->getBoard()[7])
                    || ($board->getBoard()[10] == $board->getBoard()[11] && $board->getBoard()[11] == $board->getBoard()[12])) {
                    $this->gotThree();
                }

                else {
                    $this->gotNothing();
                }

                echo $this->getCredits() . PHP_EOL;
                echo 'press 1 to play or 2 to quit/ ';
                $player->choice();
            }
        }
    }
}