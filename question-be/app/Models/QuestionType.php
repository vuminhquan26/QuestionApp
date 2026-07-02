<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    protected $table = 'ho.question_types';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'code',
        'description',
        'template',
        'version',
        'ai_usable',
        'created_at',
        'updated_at',
    ];
}
