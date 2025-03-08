<?php

namespace App\Http\Requests\Invoice;

use App\Enums\Invoice\InvoiceStatusType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInvoiceRequest extends FormRequest
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
            'tax_profile_id' => ['required', 'exists:tax_profiles,id'],
            'invoice_number' => ['required', 'string', 'max:255', 'unique:invoices'],
            'issue_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:issue_date'],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable', Rule::enum(InvoiceStatusType::class)],
        ];
    }
}
