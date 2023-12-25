<?php

namespace App\Services;

use App\Models\Wallet;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddMoneyService implements AddMoneyServiceInterface
{
    public function addMoney(array $data): int
    {
        $data['reference_id'] = rand(10000, 999999999);

        Wallet::query()->create($data);

        return $data['reference_id'];
    }

    public function getBalance(int $userId = null): int
    {
        // Note
        // Typically i would call another microservice to check the user is exists then return 0 instead of not found if user exists
        $userExists = Wallet::query()
            ->where('user_id', $userId)
            ->exists();

        if (! $userExists) {
            throw new NotFoundHttpException();
        }

        return Wallet::query()
            ->where('user_id', $userId)
            ->sum('amount');
    }
}
