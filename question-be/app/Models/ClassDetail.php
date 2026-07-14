<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassDetail extends Model
{
    protected $table = 'ho.class_details';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'description',
        'class_id',
        'session',
        'session_week',
        'session_duration',
        'session_duration_unit',
        'topic',
        'created_by',
        'updated_by'
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}
