<?php

namespace App\Http\Controllers\Panel;

use App\Lesson;
use App\Plan;
use App\Teacher;
use App\Time;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PlansController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $records = Plan::with(['time', 'teacher', 'lesson'])->get();
//        return view('admin.pages.plans.manage', ['records' => $records]);
        return view('admin.pages.plans.days');
    }

    /**
     * Display a listing of the resource.
     *
     * @param $day
     * @return \Illuminate\Http\Response
     */
    public function manage($day)
    {
        $records = Plan::with(['time', 'teacher', 'lesson'])->where('day', $day)->get();
        $times = Time::orderBy('start', 'ASC')->orderBy('end', 'ASC')->get();
        $teachers = Teacher::orderBy('family', 'ASC')->orderBy('name', 'ASC')->get();
        $lessons = Lesson::orderBy('name', 'ASC')->get();

        return view('admin.pages.plans.manage', ['day' => $day, 'records' => $records, 'times' => $times, 'teachers' => $teachers, 'lessons' => $lessons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.plans.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['day', 'time_id', 'teacher_id', 'lesson_id', 'class']);
        $rules = [
            'day' => 'required|numeric|between:0,6',
            'time_id' => 'required|numeric',
            'teacher_id' => 'required|numeric',
            'lesson_id' => 'required|numeric',
            'class' => 'required|string'
        ];
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return ['status' => 400, 'message' => 'Data is not valid.', 'errors' => $validation->errors()->toArray()];
        $record = Plan::create($data);
        return ['status' => 200, 'message' => 'New resource inserted successfully.', 'data' => $record];
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if(!$request->ajax())
            return response()->json(['status' => 403, 'message' => 'Forbidden.']);
        $model = Plan::with(['time', 'teacher', 'lesson'])->find($id);
        if(!$model)
            return ['status' => 404, 'message' => 'Not Found.'];
        return ['status' => 200, 'data' => $model->toArray()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(['time_id', 'teacher_id', 'lesson_id', 'class']);
        $rules = [
            'time_id' => 'required|numeric',
            'teacher_id' => 'required|numeric',
            'lesson_id' => 'required|numeric',
            'class' => 'required|string'
        ];
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return ['status' => 400, 'message' => 'Bad Request.', 'errors' => $validation->errors()->toArray()];
        Plan::where('id', $id)->update($data);
        return ['status' => 204, 'message' => 'Resource has been updated successfully.'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$request->ajax())
            return response()->json(['status' => 403, 'message' => 'Forbidden.']);
        Plan::destroy($id);
        return response()->json(['status' => 204, 'message' => 'Resource has been deleted successfully.']);
    }

    /**
     * Ajax Search for specific Major
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if(!$request->ajax())
            return response()->json(['status' => 403, 'message' => 'Forbidden.']);
        $data = $request->only(['name', 'day']);
        $rules = ['name'  => 'required|string', 'day' => 'required|numeric'];
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return ['status' => 400, 'message' => 'Bad Request.', 'errors' => $validation->errors()->toArray()];

        $records = Plan::with(['time', 'teacher', 'lesson'])->where('day', $data['day'])->whereHas('lesson', function($q) use ($data){
            $q->where('name','LIKE','%'.$data['name'].'%');
        })->get();

        if($records->count() < 1)
            return ['status' => 404, 'message' => 'Not Found.'];
        return ['status' => 200, 'data' => $records->toArray()];
    }
}