<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'ho.classes';

    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
        'id',
        'owner_user_id',
        'name',
        'class_code',
        'start_date',
        'end_date',
        'description',
        'syllabus_id',
        'student_package',
        'is_active',
        'link',
        'created_by',
        'updated_by'
    ];
    public function courses()
    {
        return $this->hasMany(ClassSystem::class, 'class_id');
    }

    public function sessions()
    {
        return $this->hasMany(ClassDetail::class, 'class_id');
    }
}
