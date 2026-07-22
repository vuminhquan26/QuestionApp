<?php

namespace App\Services\Implementations\Student;

use App\Services\Interfaces\Student\StudentClassServiceInterface;
use App\Models\EnrollClassUser;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;


class StudentClassService implements StudentClassServiceInterface
{

    public function joinByCode(string $classCode)
    {
        return DB::transaction(function () use ($classCode) {

            // tìm lớp theo mã
            $class = Classes::where('class_code', $classCode)->first();


            if (!$class) {
                throw new \Exception('Lớp không tồn tại');
            }


            // kiểm tra sinh viên đã tham gia chưa
            $exists = EnrollClassUser::where('class_id', $class->id)
                ->where('user_id', auth('api')->id())
                ->exists();


            if ($exists) {
                throw new \Exception('Bạn đã tham gia lớp này');
            }


            // lấy slot trống của lớp
            $enroll = EnrollClassUser::where('class_id', $class->id)
                ->whereNull('user_id')
                ->lockForUpdate()
                ->first();


            if (!$enroll) {
                throw new \Exception('Lớp đã hết chỗ');
            }


            // gán sinh viên vào lớp
            $enroll->update([
                'user_id' => auth('api')->id(),
                'used_at' => now()
            ]);


            return [
                'message' => 'Tham gia lớp thành công',
                'class_id' => $class->id
            ];

        });
    }



    public function myClasses(?string $keyword = null)
    {
        return EnrollClassUser::where('user_id', auth('api')->id())

            // tìm kiếm theo tên lớp
            ->when($keyword, function ($query) use ($keyword) {

                $query->whereHas('class', function ($query) use ($keyword) {
                    $query->where('name', 'ILIKE', "%$keyword%");
                });

            })

            // lấy thông tin lớp
            ->with('class')

            // phân trang
            ->paginate(10);
    }




    public function detail($id)
    {
        // kiểm tra sinh viên thuộc lớp
        $enroll = EnrollClassUser::where('class_id', $id)
            ->where('user_id', auth('api')->id())
            ->first();


        if (!$enroll) {
            throw new \Exception('Bạn chưa tham gia lớp này');
        }


        // lấy chi tiết lớp
        return $enroll->load([

            'class' => function ($query) {

                // đếm số sinh viên trong lớp
                $query->withCount([

                    'enrolls as total_students' => function ($query) {
                        $query->whereNotNull('user_id');
                    }

                ]);

            }

        ]);
    }





    public function getAllClasses(?string $keyword = null)
    {
        return Classes::query()


            // bỏ lớp đã tham gia
            ->whereDoesntHave('enrolls', function ($query) {

                $query->where('user_id', auth('api')->id());

            })


            // tìm kiếm lớp
            ->when($keyword, function ($query) use ($keyword) {

                $query->where(function ($sub) use ($keyword) {

                    $sub->where('name', 'ILIKE', "%$keyword%")
                        ->orWhere('class_code', 'ILIKE', "%$keyword%");

                });

            })


            // đếm số sinh viên
            ->withCount([

                'enrolls as total_students' => function ($query) {

                    $query->whereNotNull('user_id');

                }

            ])


            // phân trang
            ->paginate(10);
    }

}
