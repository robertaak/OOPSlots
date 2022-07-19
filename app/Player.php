<?php

namespace App;

class Player
{
    private int $wallet;
    private int $choice;


    public function setWallet(): void
    {
        $wallet = (int) readline();
        $this->wallet = $wallet;
    }

    public function getWallet(): int
    {
        return $this->wallet;
    }

    public function choice(): void
    {
        $choice = (int) readline();
        $this->choice = $choice;
    }

    public function getChoice(): int
    {
        return $this->choice;
    }

    public function addToWallet(int $amountToAdd): void
    {
        $this->wallet += $amountToAdd;
    }

    public function subtractFromWallet($amountToSubtract): void
    {
        $this->wallet -= $amountToSubtract;
    }

}
