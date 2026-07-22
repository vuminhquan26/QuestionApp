<?php

namespace App\Services\Implementations\Teacher;

use App\Services\Interfaces\Teacher\DashboardServiceInterface;
use Illuminate\Support\Facades\DB;

class DashboardService implements DashboardServiceInterface
{
    public function getDashboard($teacherId)
    {
        // Tổng lớp (chỉ tính lớp chưa bị xóa)
        $totalClasses = DB::table('ho.classes')
            ->where('owner_user_id', $teacherId)
            ->whereNull('deleted_at')
            ->count();

        // Tổng học viên (distinct theo user_id, chỉ tính lớp active)
        $totalStudents = DB::table('ho.enroll_class_users as ecu')
            ->join('ho.classes as c', 'c.id', '=', 'ecu.class_id')
            ->where('c.owner_user_id', $teacherId)
            ->whereNull('c.deleted_at')
            ->distinct()
            ->count('ecu.user_id');

        // Tổng khóa học (qua bảng nối class_systems, không phải course_informations)
        $totalCourses = DB::table('ho.class_systems as cs')
            ->join('ho.classes as cl', 'cl.id', '=', 'cs.class_id')
            ->join('ho.courses as c', 'c.id', '=', 'cs.course_id')
            ->where('cl.owner_user_id', $teacherId)
            ->whereNull('cl.deleted_at')
            ->whereNull('cs.deleted_at')
            ->whereNull('c.deleted_at')
            ->select(DB::raw('COUNT(DISTINCT c.id) as total'))
            ->value('total');

        // Tổng bài kiểm tra (assessment_set được giao cho các lớp của giáo viên)
        $totalExams = DB::table('ho.class_assessment_set as cas')
            ->join('ho.class_details as cd', 'cd.id', '=', 'cas.class_detail_id')
            ->join('ho.classes as cl', 'cl.id', '=', 'cd.class_id')
            ->where('cl.owner_user_id', $teacherId)
            ->whereNull('cas.deleted_at')
            ->whereNull('cd.deleted_at')
            ->whereNull('cl.deleted_at')
            ->distinct()
            ->count('cas.id');

        return [
            'courses'  => $totalCourses ?? 0,
            'students' => $totalStudents,
            'classes'  => $totalClasses,
            'exams'    => $totalExams,
        ];
    }
}
