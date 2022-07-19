<?php

namespace App;

class Board
{
    private array $board = [
        ' ', ' ', ' ', ' ', ' ',
        ' ', ' ', ' ', ' ', ' ',
        ' ', ' ', ' ', ' ', ' '
    ];

    private array $symbols = [
        '^' => 1,
        'B' => 2,
        'W' => 3,
        '#' => 4,
        '!' => 5
    ];

    public function getBoard(): array
    {
        return $this->board;
    }

    public function getSymbols(): array
    {
        return $this->symbols;
    }

    public function fillTheBoard(): void
    {
        $filledBoard = [];
        for($i = 0; $i < count($this->getBoard()); $i++) {
                $symbol = array_rand($this->getSymbols());
                $filledBoard[] = $symbol;
            }
        $this->board = $filledBoard;
    }

    public function displayBoard(Board $board): void
    {

        echo "Welcome to The Diamond Casino & Resort! \n";
        echo "-------------------\n";
        echo " {$board->getBoard()[0]} | {$board->getBoard()[1]} | {$board->getBoard()[2]} | {$board->getBoard()[3]} | {$board->getBoard()[4]}  \n";
        echo "---+---+---+---+---\n";
        echo " {$board->getBoard()[5]} | {$board->getBoard()[6]} | {$board->getBoard()[7]} | {$board->getBoard()[8]} | {$board->getBoard()[9]}\n";
        echo "---+---+---+---+---\n";
        echo " {$board->getBoard()[10]} | {$board->getBoard()[11]} | {$board->getBoard()[12]} | {$board->getBoard()[13]} | {$board->getBoard()[14]}\n";
        echo "-------------------\n";
    }
}