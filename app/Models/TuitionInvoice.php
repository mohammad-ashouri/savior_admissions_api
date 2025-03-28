<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TuitionInvoice extends Model
{
    use SoftDeletes;

    protected $table = 'tuition_invoices';

    protected $fillable = [];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
