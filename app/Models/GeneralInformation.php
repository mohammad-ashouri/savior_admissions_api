<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralInformation extends Model
{
    use SoftDeletes;

    protected $table = 'general_informations';

    protected $fillable = [];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
