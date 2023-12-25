<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\AddMoneyRequest;
use Illuminate\Http\Request;

class AddMoneyController extends Controller
{
    public function store(AddMoneyRequest $request)
    {

        return response()->json();
    }
}
