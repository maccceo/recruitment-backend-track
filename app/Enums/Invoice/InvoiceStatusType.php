<?php

namespace App\Enums\Invoice;

enum InvoiceStatusType: string
{
    case DRAFT = 'draft';
    case SENT = 'sent';
    case PAID = 'paid';
    case OVERDUE = 'overdue';
}
