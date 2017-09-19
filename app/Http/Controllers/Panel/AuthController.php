<?php

    namespace App\Http\Controllers\Panel;

    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Auth;
    use Validator;

    class AuthController extends Controller
    {
        public function Login(Request $request)
        {
            // If user is authenticated already, redirect it to dashboard
            if($request->user())
                return redirect()->route('dashboard');
            return view('admin.login');
        }

        public function Auth(Request $request)
        {
            // If data has posted to the route
            if($request->isMethod('post')){
                $data = $request->only(['username', 'password', 'captcha']);
                $rules = [
                    'username' => 'required|string',
                    'password' => 'required|min:6',
                    'captcha' => 'required|captcha'
                ];
                $validation = Validator::make($data, $rules);
                if($validation->fails())
                    return redirect()->route('login')->withErrors($validation)->withInput();

                if(!Auth::attempt([
                    'username' => $data['username'],
                    'password' => $data['password'],
                ], true))
                    return redirect()->route('login')->withErrors(['نام کاربری یا رمز عبور اشتباه است.'])->withInput();

                return redirect()->route('dashboard')->with(['alert-title' =>'ورود موفقیت آمیز', 'alert-message' => 'شما با موفقیت وارد ناحیه کاربری شدید.', 'alert-type' => 'info']);
            }
            // Else, redirect to login page
            return redirect()->route('login');
        }

        public function Logout()
        {
            // Logout authenticated user and redirect it to Login route
            Auth::logout();
            return redirect()->route('login');
        }
    }