<?php

namespace App\Http\Controllers\Panel;

use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Teacher::paginate(30);
        return view('admin.pages.teachers.manage', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.teachers.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'family', 'email', 'mobile']);
        $rules = [
            'name' => 'required|string',
            'family' => 'required|string',
            'email' => 'required|email|unique:teachers,email',
            'mobile' => ['required', 'digits:11', 'regex:/(0|\+98)?([ ]|,|-|[()]){0,2}9[0|1|2|3|4]([ ]|,|-|[()]){0,2}(?:[0-9]([ ]|,|-|[()]){0,2}){8}/','unique:teachers,mobile']
        ];
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return redirect()->route('new-teacher')->withErrors($validation)/*->with(['alert-title' =>'مشکل در اعتبارسنجی', 'alert-message' => 'لطفا ورودی ها را طبق فرمت مشخص شده وارد کنید.', 'alert-type' => 'danger'])*/;

        Teacher::create($data);
        return redirect()->route('manage-teachers')->with(['alert-title' =>'عملیات موفقیت آمیز', 'alert-message' => 'رکورد مورد نظر با موفقیت ثبت شد.', 'alert-type' => 'success']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Teacher::findOrFail($id);
        return view('admin.pages.teachers.edit', ['model' => $model]);
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
        $data = $request->only(['name', 'family', 'email', 'mobile']);
        $rules = [
            'name' => 'required|string',
            'family' => 'required|string',
            'email' => 'required|email|unique:teachers,email,'.$id,
            'mobile' => ['required', 'digits:11', 'regex:/(0|\+98)?([ ]|,|-|[()]){0,2}9[0|1|2|3|4]([ ]|,|-|[()]){0,2}(?:[0-9]([ ]|,|-|[()]){0,2}){8}/','unique:teachers,mobile,'.$id]
        ];
        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return redirect()->route('edit-teacher', $id)->withErrors($validation);
        Teacher::where('id', $id)->update($data);
        return redirect()->route('manage-teachers')->with(['alert-title' =>'عملیات موفقیت آمیز', 'alert-message' => 'زمان مورد نظر با موفقیت ویرایش شد.', 'alert-type' => 'success']);
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
            return response()->json(['status' => 'fail']);
        Teacher::destroy($id);
        return response()->json(['status' => 'success']);
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
        $data = $request->only(['name', 'family']);
        $rules = [
            'name'  => 'required_if:family,',
            'family'  => 'required_if:name,'
        ];

        $validation = Validator::make($data, $rules);
        if($validation->fails())
            return ['status' => 400, 'message' => 'Bad Request.', 'errors' => $validation->errors()->toArray()];
        if($data['name'] != '' && $data['family'] != '')
            $records = Teacher::where('name','LIKE','%'.$data['name'].'%')->where('family','LIKE','%'.$data['family'].'%')->get();
        else if($data['name'] != '')
            $records = Teacher::where('name','LIKE','%'.$data['name'].'%')->get();
        else if($data['family'] != '')
            $records = Teacher::where('family','LIKE','%'.$data['family'].'%')->get();

        if(isset($records) && $records->count() < 1)
            return ['status' => 404, 'message' => 'Not Found.'];
        return ['status' => 200, 'data' => $records->toArray()];
    }
}
