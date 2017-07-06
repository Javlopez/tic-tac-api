<?php
namespace App\Movements;

/**
 * Class BoardStateService
 *
 * @package App\Movements
 * @author  Javier Lopez Lopez <sjavierlopez@gmail.com>
 */
class BoardStateService
{
    /**
     * @var array
     */
    private $board = [
        ["", "", ""],
        ["", "", ""],
        ["", "", ""]
    ];

    const DEFAULT_O_PLAYER = "O";
    const DEFAULT_X_PLAYER = "X";

    /**
     * @var BotMovementService
     */
    private $botMovementService;

    public function __construct(BotMovementService $botMovementService)
    {
        $this->botMovementService = $botMovementService;
    }

    /**
     * @return array
     */
    public function startGame(): array
    {
        return $this->board;
    }

    /**
     * @param array      $boardState
     * @param $userPlayer
     * @return array
     */
    public function createMovement(array $boardState, $userPlayer): array
    {

        $botPlayer = ($userPlayer == static::DEFAULT_O_PLAYER)
            ? static::DEFAULT_X_PLAYER
            : static::DEFAULT_O_PLAYER;

        $positionsUpdated = $this->botMovementService->makeMove($boardState, $botPlayer);

        if ($positionsUpdated) {
            $boardState[$positionsUpdated[1]][$positionsUpdated[0]] = $positionsUpdated[2];
        }
        return $boardState;
    }
}
