<?php

namespace App\Http\Controllers\Panel;

use App\Lesson;
use App\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Lesson::orderBy('name', 'ASC')->paginate(config('system.PAGINATION_LIMIT'));
        $majors = Major::orderBy('name','ASC')->get();
        return view('admin.pages.lessons.manage', ['records' => $records, 'majors' => $majors]);
    }

    /**
     * Store a newly created Lesson resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        if(!$request->ajax())
            return response()->json(['status' => 403, 'message' => 'Forbidden.']);
        $data = $request->only(['name', 'units', 'major_id']);
        $rules = [
            'name'  => 'required|string',
            'units' => 'required|integer|min:1|max:3',
            'major_id' => 'required|integer',
        ];
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return ['status' => 400, 'message' => 'Data is not valid.', 'errors' => $validation->errors()->toArray()];
        $record = Lesson::create($data);
        return ['status' => 200, 'message' => 'New lesson inserted successfully.', 'data' => $record];
    }

    /**
     * Return the Lesson resource as JSON.
     *
     * @param Request $request
     * @param  int $id
     * @return array
     */
    public function show(Request $request, $id)
    {
        if(!$request->ajax())
            return response()->json(['status' => 403, 'message' => 'Forbidden.']);
        $model = Lesson::find($id);
        if(!$model)
            return ['status' => 404, 'message' => 'Not Found.'];
        return ['status' => 200, 'data' => $model->toArray()];
    }

    /**
     * Update the Lesson resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$request->ajax())
            return response()->json(['status' => 403, 'message' => 'Forbidden.']);
        $data = $request->only(['name', 'units', 'major_id']);
        $rules = [
            'name'  => 'required|string',
            'units' => 'required|integer|min:1|max:3',
            'major_id' => 'required|integer',
        ];
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return ['status' => 400, 'message' => 'Bad Request.', 'errors' => $validation->errors()->toArray()];
        Lesson::where('id', $id)->update($data);
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
        if(!$request->ajax())
            return response()->json(['status' => 403, 'message' => 'Forbidden.']);
        Lesson::destroy($id);
        return response()->json(['status' => 204, 'message' => 'Resource has been deleted successfully.']);
    }

    /**
     * Ajax Search for specific Lesson
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if(!$request->ajax())
            return response()->json(['status' => 403, 'message' => 'Forbidden.']);
        $data = $request->only(['name']);
        $rules = ['name'  => 'required|string'];
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return ['status' => 400, 'message' => 'Bad Request.', 'errors' => $validation->errors()->toArray()];

        $records = Lesson::where('name','LIKE','%'.$data['name'].'%')->get();

        if($records->count() < 1)
            return ['status' => 404, 'message' => 'Not Found.'];
        return ['status' => 200, 'data' => $records->toArray()];
    }
}
