<?php

namespace App\Models;

use App\Enums\TaxProfile\LegalEntityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaxProfile extends Model
{
    protected $fillable = [
        'user_id',
        'tax_code',
        'vat_number',
        'legal_entity_type'
    ];

    protected $casts = [
        'legal_entity_type' => LegalEntityType::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
