<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    protected $fillable = [
        'order_id',
        'invoice_id',
        'currency',
        'amount',
        'txn_id',
        'payment_type',
        'payment_status',
        'receipt',
        'client_id',
        'user_id'
    ];
}
