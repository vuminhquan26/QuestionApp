<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSystem extends Model
{
    protected $table = 'ho.class_systems';

    protected $fillable = [
        'class_id',
        'course_id',
        'course_code',
        'created_by',
        'updated_by'
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
