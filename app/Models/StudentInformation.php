<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentInformation extends Model
{
    use SoftDeletes;

    protected $table = 'student_informations';

    protected $fillable = [];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function guardianInfo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'guardian', 'id');
    }
}
