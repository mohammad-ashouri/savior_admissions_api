<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAccessInformation extends Model
{
    protected $table = 'user_access_informations';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
