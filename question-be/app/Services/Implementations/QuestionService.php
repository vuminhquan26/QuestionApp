<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\QuestionServiceInterface;
use App\Models\AssessmentSet;
use App\Models\User;
use App\Models\AssessmentSetDetail;
use App\Models\AssessmentItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class QuestionService implements QuestionServiceInterface
{
    public function getList(Request $request)
    {
        return AssessmentItem::with(['subject', 'creator'])
            ->when($request->keyword, function ($q, $keyword) {
                $q->where('title', 'ILIKE', "%{$keyword}%")
                    ->orWhere('id', $keyword)
                    ->orderBy('created_at', 'asc');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }

    public function getDetail(string $id)
    {
        $item = AssessmentItem::with(['subject', 'creator', 'answerType'])
            ->find($id);

        if (!$item) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return [
            'id' => $item->id,
            'title' => $item->title,
            'subject_id' => $item->subject_id,
            'question_type_code' => $item->question_type_code,
            'answer_type_code' => $item->answer_type_code,
            'difficulty' => $item->difficulty,
            'score' => $item->score,
            'status' => $item->status,
            'version' => $item->version,
            'question_data' => $item->question_data,
            'answer_data' => $item->answer_data,
        ];
    }

    public function create(Request $request)
    {
        return AssessmentItem::create([
            'id' => (string) Str::uuid(),
            'question_type_code' => $request->question_type_code,
            'answer_type_code' => $request->answer_type_code,
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'question_data' => $request->question_data,
            'answer_data' => $request->answer_data,
            'hint' => $request->hint,
            'explanation' => $request->explanation,
            'difficulty' => $request->difficulty,
            'score' => $request->score,
            'status' => 1,
            'version' => 1,
        ]);
    }

    public function update(string $id, Request $request)
    {
        $assessmentItem = AssessmentItem::findOrFail($id);

        $assessmentItem->update([
            'question_type_code' => $request->question_type_code,
            'answer_type_code' => $request->answer_type_code,
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'question_data' => $request->question_data,
            'answer_data' => $request->answer_data,
            'hint' => $request->hint,
            'explanation' => $request->explanation,
            'difficulty' => $request->difficulty,
            'score' => $request->score,
            'status' => 1,
            'version' => 1,
        ]);

        return $assessmentItem;
    }

    public function delete(string $id)
    {
        AssessmentItem::destroy($id);

        return ['message' => 'Deleted successfully'];
    }
    public function find($id)
    {
        return AssessmentItem::with(['answerType', 'subject'])
            ->findOrFail($id);
    }
}
