<?php

namespace App\Http\Requests;

use App\Enum\MacTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreMacAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'mac_address' => [
                'required',
                'string',
                'max:17',
                'unique:mac_addresses,mac_address',
                'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/', // Validates MAC address format
            ],
            'type' => ['required', 'in:'.implode(',', MacTypeEnum::values())],
            'description' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'mac_address' => 'MAC address',
            'type' => 'Type',
            'description' => 'Description',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'mac_address.required' => 'The MAC address field is required.',
            'mac_address.string' => 'The MAC address must be a string.',
            'mac_address.max' => 'The MAC address may not be greater than 17 characters.',
            'mac_address.unique' => 'The MAC address has already been taken.',
            'type.required' => 'The type field is required.',
            'type.in' => 'The selected type is invalid.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 255 characters.',
        ];
    }
}
