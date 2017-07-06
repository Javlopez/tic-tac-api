<?php
namespace App\Movements;

/**
 * Class BotMovementService
 *
 * @package App\Movements
 * @author  Javier Lopez Lopez <sjavierlopez@gmail.com>
 */
class BotMovementService implements MoveInterface
{
    /**
     * @param array  $boardState
     * @param string $playerUnit
     * @return array
     */
    public function makeMove($boardState, $playerUnit = 'X') : array
    {

        $nextPosition = [];

        for ($i = 0; $i < count($boardState); $i++) {
            $rowBoard = $boardState[$i];
            for ($j = 0; $j < count($rowBoard); $j++) {
                $currentPlayer = $boardState[$i][$j];
                if (!$currentPlayer) {
                    $nextPosition = [$j, $i, $playerUnit];
                    break 2;
                }
            }
        }

        return $nextPosition;
    }
}
