<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TuitionInvoiceDetail extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'financial_manager_description',
        'tracking_code',
        'payment_method',
        'invoice_id',
        'payment_details',
        'date_of_payment',
        'editor',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
