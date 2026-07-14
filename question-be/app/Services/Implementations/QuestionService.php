<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\QuestionServiceInterface;
use App\Models\AssessmentItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class QuestionService implements QuestionServiceInterface
{
    public function getList(Request $request)
    {
        return AssessmentItem::with(['subject', 'creator'])
            ->when($request->keyword, function ($q, $keyword) {
                $q->where(function ($query) use ($keyword) {
                    $query->where('title', 'ILIKE', "%{$keyword}%")
                        ->orWhere('id', $keyword);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }

    public function getDetail(string $id)
    {
        return AssessmentItem::with(['subject', 'creator', 'answerType'])
            ->find($id);
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
            'created_by' => auth()->id(),
        ]);
    }

    public function update(string $id, Request $request)
    {
        $item = AssessmentItem::findOrFail($id);

        if ($item->created_by !== auth()->id()) {
            throw new \Exception('Bạn không có quyền sửa');
        }

        $item->update([
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
            'version' => $item->version + 1,
        ]);

        return $item;
    }

    public function delete(string $id)
    {
        $item = AssessmentItem::findOrFail($id);
        if ($item->created_by !== auth()->id()) {
            throw new \Exception('Bạn không có quyền xoá');
        }

        $item->delete();

        return true;
    }

}
