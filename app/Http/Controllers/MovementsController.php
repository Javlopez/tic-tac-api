<?php
namespace App\Http\Controllers;

use App\Movements\BoardStateService;
use Illuminate\Http\Request;

class MovementsController extends Controller
{
    public function index(BoardStateService $boardStateService)
    {
        return response()->json($boardStateService->startGame());
    }
}
