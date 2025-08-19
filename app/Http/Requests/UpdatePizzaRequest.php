<?php

namespace App\Http\Requests;

use App\Models\Enums\PizzaStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Log;

class UpdatePizzaRequest extends FormRequest
{
    /**
     * Assume that user is logged in and authorised to make changes
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $status = PizzaStatus::tryFrom($value);

                    if (!$status || !in_array($status, $this->pizza->status->transitions())) {
                        $fail("The selected $attribute is invalid.");
                    }
                },
            ],
        ];
    }
}
