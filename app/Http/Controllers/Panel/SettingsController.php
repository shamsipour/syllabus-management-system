<?php

    namespace App\Http\Controllers\Panel;

    use App\Http\Controllers\Controller;
    use App\Lesson;
    use App\Major;
    use App\Plan;
    use App\Teacher;
    use App\Time;
    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\Storage;
    use View;
    use Maatwebsite\Excel\Facades\Excel;
    use niklasravnsborg\LaravelPdf\Facades\Pdf;
    use Validator;

    class SettingsController extends Controller
    {

        public function index()
        {
            return view('admin.pages.settings.index');
        }

        public function ExportPDF()
        {
            // Getting Plans sorted by 1. Start Time 2. End Time 3. Lesson Name
            $plans = Plan::with(['teacher'])
                ->join('times', 'times.id', '=', 'plans.time_id')
                ->join('lessons', 'lessons.id', '=', 'plans.lesson_id')
                ->orderBy('times.start')
                ->orderBy('times.end')
                ->orderBy('lessons.name')
                ->select('plans.*', 'lessons.name as lname', 'times.start', 'times.end')
                ->get();
            $data = $plans->groupBy('day');

            // TODO: Fix multiple PDF rendering (caused by mPDF)
            /*foreach($data as $day => $plans){
                $filePath = public_path('plans/'.$day.'.pdf');
                $this->makePDF('pdf.single',['day' => $day, 'plans' => $plans], $filePath);
            }*/
//            return view('pdf.complete', ["data" => $plans]);

            // Create Excel files instead of PDF until mPDF problem get fixed
            /*if(!file_exists(config('system.DAILY_PLANS_PATH')))
                mkdir(config('system.DAILY_PLANS_PATH'), 777);
            foreach($data as $day => $plans){
                Excel::create($day, function($excel) use ($day, $plans){
                    $excel->setTitle('Shamsipour Daily Classes');
                    $excel->setCreator('Erfan Sahafnejad')
                        ->setCompany('Shamsipour College');

                    $excel->sheet(config('system.DAYS')[$day], function($sheet) use($plans) {
                        $sheet->fromArray($plans->toArray(), null, 'A1', true);
                    });
                })->store('xls', config('system.DAILY_PLANS_PATH'));
            }*/


            // Plans of the week storing path
            $fullPlansPath = public_path('plans/full-plans.pdf');
            $this->makePDF('pdf.complete', ["data" => $data], $fullPlansPath);
            return redirect(url('plans/full-plans.pdf'));
        }

        public function ExportDatabaseAsExcel()
        {
            $fileName = 'Shamsipour Backup '.date('Y/m/d H:i');

            Excel::create($fileName, function($excel) {
                $excel->setTitle('Shamsipour Weekly Classes Plan');
                $excel->setCreator('Erfan Sahafnejad')
                    ->setCompany('Shamsipour College');
                $excel->sheet('users', function($sheet) {
                    $sheet->fromModel(User::all(), null, 'A1', true);
                });
                $excel->sheet('times', function($sheet) {
                    $sheet->fromModel(Time::all(), null, 'A1', true);
                });
                $excel->sheet('majors', function($sheet) {
                    $sheet->fromModel(Major::all(), null, 'A1', true);
                });
                $excel->sheet('lessons', function($sheet) {
                    $sheet->fromModel(Lesson::all()->makeHidden(['level_caption'])->makeVisible(['id', 'major_id']), null, 'A1', true);
                });
                $excel->sheet('teachers', function($sheet) {
                    $sheet->fromModel(Teacher::all()->makeVisible(['mobile', 'email']), null, 'A1', true);
                });
                $excel->sheet('plans', function($sheet) {
                    $sheet->fromModel(Plan::all()->makeVisible(['id', 'created_at', 'updated_at', 'time_id', 'lesson_id', 'teacher_id']), null, 'A1', true);
                });
            })->download('xls');
        }

        /**
         * Import selected excel file to database
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function ImportDatabaseFromExcel(Request $request)
        {
            $this->validate($request, ['file' => 'required|file']);
            $file = $request->file('file');
            // Get file original extension and validate it
            $ext = $file->getClientOriginalExtension();
            if($ext !== "xls")
                return redirect()->route('settings')->with(['alert-type' => 'danger', 'alert-title' => 'مشکل در بازگردانی دیتابیس', 'alert-message' => 'تنها فایل های اکسل با پسوند xls قابل قبول هستند.']);

            Excel::load($file->getRealPath(), function($reader) {
                $reader->each(function($sheet){
                    $table = strtolower($sheet->getTitle());
                    $columns = Schema::getColumnListing($table);
                    $data = $sheet->toArray();
                    // Remove those fields that are not exist in table's columns
//                    dump($data);
                    foreach($data as $recordKey => $record)
                        foreach($record as $key => $value)
                            if(!in_array($key, $columns))
                                unset($data[$recordKey][$key]);
//                    dump($data);
                    // Empty all tables except users table
                    if($table != 'users'){
                        DB::table($table)->delete();
                        DB::table($table)->insert($data);
                    }
                });
            });
            return redirect()->route('settings')->with(['alert-type' => 'success', 'alert-title' => 'عملیات با موفقیت انجام شد.', 'alert-message' => 'اطلاعات تمامی جداول بجز جدول کاربران با موفقیت بازگردانی شد.']);
        }

        /**
         * Private PDF Maker function
         *
         * @param string $view
         * @param array $data
         * @param string $path
         */
        private function makePDF($view, $data = [], $path)
        {
            $pdf = PDF::loadView($view, $data);
            $pdf->mpdf->SetWatermarkImage(public_path('img/logo1.png'));
            $pdf->mpdf->showWatermarkImage = true;
            // Delete old version of the file
            if(file_exists($path))
                Storage::delete($path);
            $pdf->save($path);
        }
    }
