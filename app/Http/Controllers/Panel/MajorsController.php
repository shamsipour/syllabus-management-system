<?php

namespace App\Http\Controllers\Panel;

use App\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;

class MajorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Major::with('lessons')->orderBy('name', 'ASC')->paginate(config('system.PAGINATION_LIMIT'));
        return view('admin.pages.majors.manage', ['records' => $records]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax())
            return response()->json(['status' => 403, 'message' => 'Forbidden.']);
        $data = $request->only(['name', 'level']);
        $rules = [
            'name'  => 'required|string',
            'level' => 'required|integer|min:0|max:'.count(config('system.MAJOR_LEVELS'))
        ];
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return ['status' => 400, 'message' => 'Data is not valid.', 'errors' => $validation->errors()->toArray()];
        $record = Major::create($data);
        return ['status' => 200, 'message' => 'New major inserted successfully.', 'data' => $record];
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
        $model = Major::find($id);
        if(!$model)
            return ['status' => 404, 'message' => 'Not Found.'];
        return ['status' => 200, 'data' => $model->toArray()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$request->ajax())
            return response()->json(['status' => 403, 'message' => 'Forbidden.']);
        $data = $request->only(['name', 'level']);
        $rules = [
            'name'  => 'required|string',
            'level' => 'required|integer|min:0|max:'.count(config('system.MAJOR_LEVELS'))
        ];
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return ['status' => 400, 'message' => 'Bad Request.', 'errors' => $validation->errors()->toArray()];
        Major::where('id', $id)->update($data);
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
        Major::destroy($id);
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
        $data = $request->only(['name', 'level']);
        $rules = ['name'  => 'required|string'];
        if($data['level'] != 'all')
            $rules['level'] = 'required|integer|min:0|max:'.count(config('system.MAJOR_LEVELS'));
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return ['status' => 400, 'message' => 'Bad Request.', 'errors' => $validation->errors()->toArray()];

        $records = $data['level'] == 'all' ? $records = Major::where('name','LIKE','%'.$data['name'].'%')->get() : Major::where('name','LIKE','%'.$data['name'].'%')->where('level', $data['level'])->get();

        if($records->count() < 1)
            return ['status' => 404, 'message' => 'Not Found.'];
        return ['status' => 200, 'data' => $records->toArray()];
    }
}
