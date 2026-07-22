<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\Student\StudentClassServiceInterface;


class StudentClassController extends Controller
{

    protected $service;


    public function __construct(StudentClassServiceInterface $service)
    {
        $this->service = $service;
    }


    public function join(Request $request)
    {
        $request->validate([
            'code'=>'required'
        ]);

        return response()->json(
            $this->service->joinByCode($request->code)
        ); // join lớp bằng mã
    }


    public function myClasses(Request $request)
    {
        return response()->json(
            $this->service->myClasses($request->keyword)
        ); // lấy lớp đã tham gia
    }


    public function detail($id)
    {
        return response()->json(
            $this->service->detail($id)
        ); // xem chi tiết lớp
    }


    public function all(Request $request)
    {
        return response()->json(
            $this->service->getAllClasses($request->keyword)
        ); // xem tất cả lớp
    }

}
