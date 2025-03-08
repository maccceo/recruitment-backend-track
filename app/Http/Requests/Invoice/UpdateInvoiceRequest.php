<?php

namespace App\Http\Requests\Invoice;

use App\Enums\Invoice\InvoiceStatusType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
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
            'tax_profile_id' => ['sometimes', 'exists:tax_profiles,id'],
            'invoice_number' => ['sometimes', 'string', 'max:255', Rule::unique('invoices')->ignore($this->invoice)],
            'issue_date' => ['sometimes', 'date'],
            'due_date' => ['sometimes', 'date', 'after_or_equal:issue_date'],
            'total_amount' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['nullable', Rule::enum(InvoiceStatusType::class)],
        ];
    }
}
