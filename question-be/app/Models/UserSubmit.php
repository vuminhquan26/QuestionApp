<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubmit extends Model
{
    protected $table = 'ho.user_submits';
    protected $fillable = [
        'id',
        'teacher_id',
        'user_id',
        'assessment_set_id',
        'total_grade'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id' );
    }
    public function assessmentSet()
    {
        return $this->belongsTo(AssessmentSet::class, 'assessment_set_id', 'id');
    }
}
