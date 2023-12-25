<?php

namespace App\Rules;

use App\Models\Wallet;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotNegativeWalletValueRule implements ValidationRule
{
    public function __construct(
        protected $userId = null,
        protected readonly bool $isNegative = false,
    )
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->userId || ! is_numeric($this->userId)) {
            return;
        }

        $sum = Wallet::query()
            ->where('user_id', $this->userId)
            ->sum('amount');

        $sum = $this->isNegative ? $sum - $value :  $sum + $value;

        if ($sum < 0) {
            $fail('Entered amount for this user is more than current amount of wallet');
        }
    }
}
