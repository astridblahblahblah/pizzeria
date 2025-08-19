<?php

namespace App\Http\Requests;

use App\Models\Enums\PizzaStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Log;

class UpdatePizzaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Assume that user is logged in and authorised to make changes
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        Log::info($this->pizza->status->transitions());

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
