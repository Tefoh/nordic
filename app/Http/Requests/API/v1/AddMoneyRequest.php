<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class AddMoneyRequest extends FormRequest
{
    private bool $isNegative = false;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $amount = $this->get('amount') ?? 0;
        $this->merge([
            'amount' => is_numeric($amount) ? abs($amount) : $amount
        ]);
        if (is_numeric($amount) && $amount < 0) {
            $this->isNegative = true;
        }
    }

    public function passedValidation()
    {
        if ($this->isNegative) {
            $this->merge([
                'amount' =>  intval('-' .$this->get('amount'))
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'not_in:0'],
            'amount' => ['required', 'integer', 'not_in:0'],
        ];
    }
}
