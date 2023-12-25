<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\AddMoneyRequest;
use App\Models\Wallet;
use Illuminate\Http\Request;

class AddMoneyController extends Controller
{
    public function store(AddMoneyRequest $request)
    {
        $data = $request->toArray();

        $data['reference_id'] = rand(10000, 999999999);

        Wallet::query()->create($data);

        return response()->json([
            'reference_id' => $data['reference_id']
        ]);
    }
}
