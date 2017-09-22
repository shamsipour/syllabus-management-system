<?php

    namespace App\Http\Controllers\API;

    use App\Major;
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
            $major_id = $request->get('major_id', null);

            // Get all plans
            $plans = Plan::join('times', 'times.id', '=', 'plans.time_id')
                ->join('teachers', 'teachers.id', '=', 'plans.teacher_id')
                ->join('lessons', 'lessons.id', '=', 'plans.lesson_id')
                ->join('majors', 'majors.id', '=', 'lessons.major_id')
                ->select('plans.class', 'plans.day', 'times.start', 'times.end', 'lessons.name as lesson_name', DB::raw('CONCAT(teachers.name, " ", teachers.family) AS teacher_name'), 'majors.name as major_name')
                ->orderBy('times.start')
                ->orderBy('times.end')
                ->orderBy('lessons.name')
                ->orderBy('majors.name');

            // Filter plans based on their day
            if ($day != null && is_int((int)$day) && $day <= 6 && $day >= 0)
                $plans = $plans->where('plans.day', (int)$day);
            // Filter plans based on their major
            if ($major_id != null && is_int((int)$major_id))
                $plans = $plans->where('majors.id', (int)$major_id);

            $plans = $plans->get();

            $caption = 'برنامه کلاس های ';
            if($day != null || $major_id != null){
                $caption .= $day != null ? 'روز ' . config('system.DAYS')[$day] . ' ' : '';
                if($major_id != null){
                    $major = Major::findOrFail($major_id)->first();
                    $caption .= 'رشته '.$major->name;
                    $caption .= ' مقطع '.$major->level_caption;
                }
            }
            else
                $caption .= 'هفتگی دانشگاه';
            return ['success' => true, 'caption' => trim($caption), 'data' => $plans];
        }
    }
