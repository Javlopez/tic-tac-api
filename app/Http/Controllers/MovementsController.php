<?php
namespace App\Http\Controllers;

use App\Movements\BoardStateService;
use Illuminate\Http\Request;

/**
 * Class MovementsController
 *
 * @package App\Http\Controllers
 * @author  Javier Lopez Lopez <sjavierlopez@gmail.com>
 */
class MovementsController extends Controller
{
    /**
     * @param BoardStateService $boardStateService
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(BoardStateService $boardStateService)
    {
        return response()->json($boardStateService->startGame());
    }

    /**
     * @param Request           $request
     * @param BoardStateService $boardStateService
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request, BoardStateService $boardStateService)
    {
        $boardState = $request->json()->all();
        return response()->json(
            $boardStateService->createMovement(
                $boardState,
                $request->header('X-Player')
            )
        );
    }
}
