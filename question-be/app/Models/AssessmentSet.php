<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssessmentItem;
use App\Models\AssessmentSetDetail;
use App\Models\User;
use App\Models\Subject;

class AssessmentSet extends Model
{
    protected $table = 'ho.assessment_sets';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_by',
        'updated_by',
        'difficulty',
        'subject_id',
        'status',
        'syllabus_id',
        'assessment_set_time'
    ];

    // thuộc về 1 user
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    // thuộc về 1 subject
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }


    public function details()
    {
        return $this->hasMany(AssessmentSetDetail::class, 'set_id', 'id');
    }



}
