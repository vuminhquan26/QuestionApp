<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AssessmentSet;
use App\Models\AssessmentItem;

class AssessmentSetDetail extends Model
{
    protected $table = 'ho.assessment_set_detail';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'set_id',
        'assessment_item_id',
        'position'
    ];

    // thuộc về 1 bộ đề
    public function set()
    {
        return $this->belongsTo(AssessmentSet::class, 'set_id', 'id');
    }

    // thuộc về 1 câu hỏi
    public function item()
    {
        return $this->belongsTo(AssessmentItem::class, 'assessment_item_id', 'id');
    }
}