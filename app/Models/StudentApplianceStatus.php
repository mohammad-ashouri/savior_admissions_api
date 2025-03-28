<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentApplianceStatus extends Model
{
    use SoftDeletes;

    protected $table = 'student_appliance_statuses';

    protected $fillable = [];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
