<?php
namespace App\Movements;

class BoardStateService
{
    private $board = ["", "", "", "", "", "", "", "", ""];

    public function startGame(): array
    {
        return $this->board;
    }
}
