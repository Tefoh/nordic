<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Services\AddMoneyServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetBalanceController extends Controller
{
    public function __construct(
        private readonly AddMoneyServiceInterface $addMoneyService
    )
    { }

    public function index(Request $request)
    {
        $balance = $this->addMoneyService->getBalance($request->get('user_id'));

        return response()->json([
            'balance' => $balance
        ]);
    }
}
