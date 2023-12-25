<?php

namespace App\Services;

use App\Models\Wallet;

class AddMoneyService implements AddMoneyServiceInterface
{
    public function addMoney(array $data): int
    {
        $data['reference_id'] = rand(10000, 999999999);

        Wallet::query()->create($data);

        return $data['reference_id'];
    }
}
