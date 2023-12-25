<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\AddMoneyRequest;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AddMoneyController extends Controller
{
    public function store(AddMoneyRequest $request)
    {
        $data = $request->toArray();

        $data['reference_id'] = rand(10000, 999999999);

        $sum = Wallet::query()
            ->where('user_id', $data['user_id'])
            ->sum('amount');

        $sum += $data['amount'];

        if ($sum < 0) {
            throw ValidationException::withMessages([
                'amount' => [
                    'Entered amount for this user is more than current amount of wallet'
                ]
            ]);
        }

        Wallet::query()->create($data);

        return response()->json([
            'reference_id' => $data['reference_id']
        ]);
    }
}
