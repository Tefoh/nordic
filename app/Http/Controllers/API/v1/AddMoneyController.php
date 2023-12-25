<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddMoneyController extends Controller
{
    public function store(Request $request)
    {
        $amount = $request->get('amount') ?? 0;
        $request->merge([
            'amount' => is_numeric($amount) ? abs($amount) : null
        ]);
        $this->validate($request, [
            'user_id' => ['required', 'integer', 'not_in:0'],
            'amount' => ['required', 'integer', 'not_in:0'],
        ]);

        return response()->json();
    }
}
