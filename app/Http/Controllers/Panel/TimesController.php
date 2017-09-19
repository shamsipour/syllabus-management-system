<?php

    namespace App\Http\Controllers\Panel;


    use App\Http\Controllers\Controller;
    use App\Time;
    use Illuminate\Http\Request;
    use Validator;

    class TimesController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $records = Time::all();
            return view('admin.pages.times.manage', ['records' => $records]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('admin.pages.times.new');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $data = $request->only(['start_time', 'end_time']);
            $rules = [
                'start_time' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^'],
                'end_time' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^']
            ];
            $validation = Validator::make($data, $rules);
            if($validation->fails())
                return redirect()->route('new-time')->with(['alert-title' =>'مشکل در اعتبارسنجی', 'alert-message' => 'لطفا زمان ها را طبق فرمت مشخص شده وارد کنید.', 'alert-type' => 'danger']);

            Time::create(['start' => $data['start_time'], 'end' => $data['end_time']]);
            return redirect()->route('manage-times')->with(['alert-title' =>'عملیات موفقیت آمیز', 'alert-message' => 'زمان مورد نظر با موفقیت ایجاد شد.', 'alert-type' => 'success']);
        }

        public function edit($id)
        {
            $model = Time::findOrFail($id);
            return view('admin.pages.times.edit', ['model' => $model]);
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
            $data = $request->only(['start_time', 'end_time']);
            $rules = [
                'start_time' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^'],
                'end_time' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^']
            ];
            $validation = Validator::make($data, $rules);
            if($validation->fails())
                return redirect()->route('edit-time', $id)->with(['alert-title' =>'مشکل در اعتبارسنجی', 'alert-message' => 'لطفا زمان ها را طبق فرمت مشخص شده وارد کنید.', 'alert-type' => 'danger']);
            Time::where('id', $id)->update(['start' => $data['start_time'], 'end' => $data['end_time']]);
            return redirect()->route('manage-times')->with(['alert-title' =>'عملیات موفقیت آمیز', 'alert-message' => 'زمان مورد نظر با موفقیت ویرایش شد.', 'alert-type' => 'success']);
        }

        public function destroy(Request $request, $id)
        {
            if(!$request->ajax())
                return response()->json(['status' => 'fail']);
            Time::destroy($id);
            return response()->json(['status' => 'success']);
//            return redirect()->route('manage-times')->with(['alert-title' =>'عملیات موفقیت آمیز', 'alert-message' => 'زمان مورد نظر با موفقیت حذف شد.', 'alert-type' => 'success']);
        }
    }
