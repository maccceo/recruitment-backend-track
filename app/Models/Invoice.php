<?php

namespace App\Models;

use App\Enums\Invoice\InvoiceStatusType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'tax_profile_id',
        'invoice_number',
        'issue_date',
        'due_date',
        'total_amount',
        'status'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'total_amount' => 'decimal:2',
        'status' => InvoiceStatusType::class
    ];

    public function taxProfile(): BelongsTo
    {
        return $this->belongsTo(TaxProfile::class);
    }
}
