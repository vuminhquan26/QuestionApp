<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AnswerType;
use App\Models\Subject;
use App\Models\AssessmentSetDetail;
use App\Models\User;

class AssessmentItem extends Model
{
    protected $table = 'ho.assessment_items';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'difficulty',
        'score',
        'status',
        'question_type_code',
        'answer_type_code',
        'subject_id',
        'version',
        'question_data',
        'answer_data',
        'created_by',
    ];

    // auto convert JSON
    protected $casts = [
        'question_data' => 'array',
        'answer_data' => 'array',
    ];

    // loại đáp án
    public function answerType()
    {
        return $this->belongsTo(
            AnswerType::class,
            'answer_type_code',
            'code'
        );
    }

    // môn học
    public function subject()
    {
        return $this->belongsTo(
            Subject::class,
            'subject_id',
            'id'
        );
    }

    // người tạo
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // 1 câu hỏi thuộc nhiều set (qua detail)
    public function setDetails()
    {
        return $this->hasMany(
            AssessmentSetDetail::class,
            'assessment_item_id',
            'id'
        );
    }
}