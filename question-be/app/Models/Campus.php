<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $table = 'ho.campus';

    protected $primaryKey = 'campus_code';

    public $incrementing = false; // vì PK là varchar

    protected $keyType = 'string';

    protected $fillable = [
        'campus_code',
        'campus_desc',
        'active_status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
