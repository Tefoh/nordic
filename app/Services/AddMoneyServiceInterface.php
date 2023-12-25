<?php

namespace App\Services;

use App\Models\Wallet;

interface AddMoneyServiceInterface
{
    public function addMoney(array $data): int;

    public function getBalance(int $userId = null): int;
}
