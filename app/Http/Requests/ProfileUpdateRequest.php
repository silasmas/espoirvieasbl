<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique(User::class, 'phone')->ignore($this->user()->id),
            ],
            'country' => ['nullable', 'string', 'max:100'],
            'donation_period' => ['nullable', 'date'],
            'donation_type' => ['nullable', 'string', 'in:espece,nature'],
            'donation_amount' => ['nullable', 'numeric', 'min:1'],
            'donation_currency' => ['nullable', 'string', 'in:USD,CDF'],
            'donation_description' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
