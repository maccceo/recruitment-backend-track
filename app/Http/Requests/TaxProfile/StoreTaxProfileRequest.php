<?php

namespace App\Http\Requests\TaxProfile;

use App\Enums\TaxProfile\LegalEntityType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaxProfileRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'tax_code' => ['required', 'string', 'max:255', 'unique:tax_profiles'],
            'vat_number' => ['nullable', 'string', 'max:255'],
            'legal_entity_type' => ['required', Rule::enum(LegalEntityType::class)],
        ];
    }
}
