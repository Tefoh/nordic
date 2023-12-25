<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\AddMoneyRequest;
use App\Models\Wallet;
use App\Services\AddMoneyServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AddMoneyController extends Controller
{
    public function __construct(
        private readonly AddMoneyServiceInterface $addMoneyService
    )
    { }

    public function store(AddMoneyRequest $request)
    {
        $reference = $this->addMoneyService->addMoney($request->toArray());

        return response()->json([
            'reference_id' => $reference
        ]);
    }
}
