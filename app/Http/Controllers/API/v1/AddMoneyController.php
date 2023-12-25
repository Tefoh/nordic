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

        Wallet::query()->create($data);

        return response()->json();
    }
}
