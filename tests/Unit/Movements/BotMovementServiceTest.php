<?php
namespace Tests\Unit\Movements;

use App\Movements\BotMovementService;
use Tests\TestCase;

class BotMovementServiceTest extends TestCase
{
    /**
     * @test
     * @dataProvider getBoardState
     */
    public function itShouldReturnAvailablePosition($boardState, $expectedPosition, $playerUnit)
    {
        $botMovementService = new BotMovementService();
        $position = $botMovementService->makeMove($boardState, $playerUnit);

        $this->assertEquals($position, $expectedPosition);

    }

    public function getBoardState(): array
    {
        return [
            [
                [["", "", ""], ["", "", ""],["", "", ""]],
                [0,0,'X'],
                'X'
            ],
            [
                [["O", "", ""], ["", "", ""],["", "", ""]],
                [1,0,'X'],
                'X'
            ],
            [
                [["X", "", ""], ["", "", ""],["", "", ""]],
                [1,0,'O'],
                'O'
            ],
            [
                [["O", "X", ""], ["", "", ""],["", "", ""]],
                [2,0,'X'],
                'X'
            ],
            [
                [["O", "X", "O"], ["", "", ""],["", "", ""]],
                [0,1,'X'],
                'X'
            ],
            [
                [["O", "X", "O"], ["X", "", ""],["", "", ""]],
                [1,1,'X'],
                'X'
            ],
            [
                [["O", "X", "O"], ["X", "X", ""],["", "", ""]],
                [2,1,'X'],
                'X'
            ],
            [
                [["O", "X", "O"], ["X", "O", "X"],["", "", ""]],
                [0,2,'X'],
                'X'
            ],
            [
                [["O", "X", "O"], ["X", "O", "X"],["O", "", ""]],
                [1,2,'X'],
                'X'
            ],
            [
                [["O", "X", "O"], ["X", "O", "X"],["O", "O", ""]],
                [2,2,'X'],
                'X'
            ],
            [
                [["O", "X", "O"], ["X", "O", "X"],["O", "O", "X"]],
                [],
                'X'
            ],
        ];
    }
}