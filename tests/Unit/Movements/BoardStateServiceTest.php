<?php

namespace Tests\Unit\Movements;

use Tests\TestCase;
use App\Movements\BoardStateService;

/**
 * Class BoardStateServiceTest
 * @package Tests\Unit\Movements
 */
class BoardStateServiceTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturnAnEmptyBoard()
    {
        $mockBotService = $this->createMock('\\App\\Movements\\BotMovementService');
        $boardStateService = new BoardStateService($mockBotService);

        $expectedStartGame = [
            ["", "", ""],
            ["", "", ""],
            ["", "", ""]
        ];

        $this->assertEquals($boardStateService->startGame(), $expectedStartGame);
    }

    /**
     * @param $boardState
     * @param $position
     * @param $expectedState
     * @param $userPlayer
     * @param $botPlayer
     * @test
     * @dataProvider getBoardState
     */
    public function itShouldReturnBoardStateWithBotPlayerUsed(
        $boardState,
        $position,
        $expectedState,
        $userPlayer,
        $botPlayer
    ) {


        $mockBotService = $this->getMockBuilder('\\App\\Movements\\BotMovementService')
            ->disableOriginalConstructor()
            ->setMethods(['makeMove'])
            ->getMock();

        $mockBotService
            ->expects($this->once())
            ->method('makeMove')
            ->with($boardState, $botPlayer)
            ->will($this->returnValue($position));

        $boardStateService = new BoardStateService($mockBotService);
        $result = $boardStateService->createMovement($boardState, $userPlayer);
        $this->assertEquals($expectedState, $result);
    }

    public function getBoardState(): array
    {
        return [
            [
                [["", "", ""], ["", "", ""],["", "", ""]],
                [0,0,'O'],
                [["O", "", ""], ["", "", ""],["", "", ""]],
                'X',
                'O'
            ],
            [
                [["X", "", ""], ["", "", ""],["", "", ""]],
                [1,0,'O'],
                [["X", "O", ""], ["", "", ""],["", "", ""]],
                'O',
                'X'
            ],
            [
                [["O", "X", ""], ["", "", ""],["", "", ""]],
                [2,0,'X'],
                [["O", "X", "X"], ["", "", ""],["", "", ""]],
                'X',
                'O'
            ],
            [
                [["O", "X", "X"], ["", "", ""],["", "", ""]],
                [0,1,'O'],
                [["O", "X", "X"], ["O", "", ""],["", "", ""]],
                'O',
                'X'
            ],
            [
                [["O", "X", "O"], ["O", "", ""],["", "", ""]],
                [1,1,'X'],
                [["O", "X", "O"], ["O", "X", ""],["", "", ""]],
                'X',
                'O'
            ],
            [
                [["O", "X", "O"], ["X", "X", ""],["", "", ""]],
                [2,1,'O'],
                [["O", "X", "O"], ["X", "X", "O"],["", "", ""]],
                'X',
                'O'
            ],
            [
                [["O", "X", "O"], ["X", "O", "X"],["", "", ""]],
                [0,2,'X'],
                [["O", "X", "O"], ["X", "O", "X"],["X", "", ""]],
                'X',
                'O'
            ],
            [
                [["O", "X", "O"], ["X", "O", "X"],["O", "", ""]],
                [1,2,'X'],
                [["O", "X", "O"], ["X", "O", "X"],["O", "X", ""]],
                'X',
                'O'
            ],
            [
                [["O", "X", "O"], ["X", "O", "X"],["O", "O", ""]],
                [2,2,'X'],
                [["O", "X", "O"], ["X", "O", "X"],["O", "O", "X"]],
                'X',
                'O'
            ],
            [
                [["O", "X", "O"], ["X", "O", "X"],["O", "O", "X"]],
                [],
                [["O", "X", "O"], ["X", "O", "X"],["O", "O", "X"]],
                'X',
                'O'
            ],
        ];
    }
}