<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetBalanceController extends Controller
{
    public function index(Request $request)
    {
        $userExists = Wallet::query()
            ->where('user_id', $request->get('user_id'))
            ->exists();

        if (! $userExists) {
            throw new NotFoundHttpException();
        }

        $balance = Wallet::query()
            ->where('user_id', $request->get('user_id'))
            ->sum('amount');

        return response()->json([
            'balance' => $balance
        ]);
    }
}
