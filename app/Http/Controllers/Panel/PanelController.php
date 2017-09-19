<?php


    namespace App\Http\Controllers\Panel;


    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class PanelController extends Controller
    {
        public function Dashboard()
        {
            return view('admin.pages.dashboard');
        }
    }