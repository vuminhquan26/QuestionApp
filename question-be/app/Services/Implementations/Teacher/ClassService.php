<?php

namespace App\Services\Implementations\Teacher;

use App\Services\Interfaces\Teacher\ClassServiceInterface;
use App\Models\Classes;

class ClassService implements ClassServiceInterface
{
    public function getList(array $filters)
    {
        return Classes::query()
            ->where('owner_user_id', auth()->id())
            ->paginate(10);
    }

    public function create(array $data)
    {
        return Classes::create([
            ...$data,
            'owner_user_id' => auth()->id(),
            'created_by' => auth()->id()
        ]);
    }

    public function detail($id)
    {
        return Classes::with(['courses', 'sessions'])
            ->where('owner_user_id', auth()->id())
            ->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $class = Classes::where('owner_user_id', auth()->id())
            ->findOrFail($id);

        $class->update($data);

        return $class;
    }

    public function delete($id)
    {
        $class = Classes::where('owner_user_id', auth()->id())
            ->findOrFail($id);

        $class->delete();

        return true;
    }
}
