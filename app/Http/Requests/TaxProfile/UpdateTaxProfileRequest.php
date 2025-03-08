<?php

namespace App\Http\Requests\TaxProfile;

use App\Enums\TaxProfile\LegalEntityType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaxProfileRequest extends FormRequest
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
            'user_id' => ['sometimes', 'exists:users,id'],
            'tax_code' => ['sometimes', 'string', 'max:255', Rule::unique('tax_profiles')->ignore($this->tax_profile)],
            'vat_number' => ['sometimes', 'nullable', 'string', 'max:255'],
            'legal_entity_type' => ['sometimes', Rule::enum(LegalEntityType::class)],
        ];
    }
}
