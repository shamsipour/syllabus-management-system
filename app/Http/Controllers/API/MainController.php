<?php

namespace App\Http\Controllers\API;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    // Handle plans API endpoint
    public function getPlans(Request $request)
    {
        // Get day from query string
        $day = $request->get('day', null);


        // Return if day was not an integer or it was greater than 6/less than 0
        if($day == null || !is_int((int)$day) || $day > 6 || $day < 0)
            return ['success' => false, 'message' => 'You should pass a specific day as a query string parameter in Integer type', 'data' => null];

        // Get plans of a specific day based on Major ID
        $plans = Plan::
        join('times', 'times.id', '=', 'plans.time_id')
            ->join('teachers', 'teachers.id', '=', 'plans.teacher_id')
            ->join('lessons', 'lessons.id', '=', 'plans.lesson_id')
            ->join('majors', 'majors.id', '=', 'lessons.major_id')
            ->select('plans.class', 'times.start', 'times.end', 'lessons.name as lesson_name', DB::raw('CONCAT(teachers.name, " ", teachers.family) AS teacher_name'), 'majors.name as major_name')
            ->where('day', $day)
            ->orderBy('times.start')
            ->orderBy('times.end')
            ->orderBy('lessons.name')
            ->orderBy('majors.name')
            ->get();

        $caption = 'برنامه روز '.config('system.DAYS')[$day];
        return ['success' => true, 'caption' => $caption, 'data' => $plans];
    }
}
