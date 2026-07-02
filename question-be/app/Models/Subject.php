<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{   
    public $incrementing = false;   
    protected $keyType = 'String';
    protected $table = 'ho.subjects';
    protected $fillable = [
        'id',
        'name',
        'description',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',   
        'priority',
        'deleted_at',
        'deleted_by'
    ];

}
