<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerType extends Model
{
    protected $table = 'ho.answer_types';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'code',
        'description',
        'template',
        'version',
        'ai_usable',
    ];
}
