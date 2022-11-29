<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use Session;
use App\services\EmailNotification;
use App\Models\User;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        return view('front.auth.login');
    }

    public function login(Request $request)
    {
       
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard');

        }
  
        return redirect('login')->with('success', 'Login details are not valid');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'required|email|unique:users',        
            'contact' => 'required',
        ]);
       
        $input = $request->except('_token');
        $randomString = Str::random(6);
        $input['password'] =Hash::make($randomString);
        $input = User::create($input);
        $sendNotification = new EmailNotification();
        $heading = "Registration Invitation";
        $subject = "Your account has been successfully created at Test Task CarManagement System. ";
        $sendNotification->login_email($request->name,$request->email,$randomString,$heading,$subject);
        return back()->with("status", "Account successfully created! Login credintials send to The given Email");
    }

    public function reset(Request $request)
    {
       return view('front.auth.reset');
    }

    public function reset_post(Request $request)
    {
        $request->validate([

            'email' => 'required|email|exists:users',        
        ]);
       
        $randomString = Str::random(6);
        $input = User::where('email', $request->email)->first();
   
        $input->password = Hash::make($randomString);
        $input->save();
        $sendNotification = new EmailNotification();
        $heading = "Reset Password";
        $subject = "Your password has been successfully reset.New login Credintials are :";
        $sendNotification->login_email($input->name,$request->email,$randomString,$heading,$subject);
        return redirect()->route('login')->with("status", "Password successfully Resset! New Login credintials are send to the given Email");
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return Redirect('/');
    }
}
