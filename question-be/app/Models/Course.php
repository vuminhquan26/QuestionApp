<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'ho.courses';

    protected $primaryKey = 'id';

    public $incrementing = false; // vì id là varchar

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'category_id',
        'course_code',
        'course_name',
        'description',
        'course_type',
        'course_duration',
        'course_duration_unit',
        'course_language',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

}
