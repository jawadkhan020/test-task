<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use Session;
use Validator;
use App\services\EmailNotification;
use App\services\helpers;
use App\Models\User;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',        
            'contact' => 'required',
        ]);
        try{
            if ($validator->fails())
            {
                return response()->json([
                    'code' => '422',
                    'message' => 'Validation Error',
                    'data' => $validator->errors()
                ]);
            }else{
                $input = $request->except('_token');
                $randomString = Str::random(6);
                $input['password'] =Hash::make($randomString);
                $input = User::create($input);
                $sendNotification = new EmailNotification();
                $heading = "Registration Invitation";
                $subject = "Your account has been successfully created at Test Task CarManagement System. ";
                $sendNotification->login_email($request->name,$request->email,$randomString,$heading,$subject);
                return response()->json([
                    'code' => '200',
                    'message' => 'Account successfully created! Login credintials send to The given Email',
                    
                ]);

            }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
}  
      
    }

    /**
     * Sign-in user .
     *
     * @return \Illuminate\Http\Response
     */
    public function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',        
            'password' => 'required',
        ]);
        try{
            if ($validator->fails())
            {
                return response()->json([
                    'code' => '422',
                    'message' => 'Validation Error',
                    'data' => $validator->errors()
                ]);
            }else{

                if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                    
                    $api_token =   Str::random(25);
                   User ::where('email', $request->email)->update(['api_token' => $api_token]);

                   $data = User ::select('name', 'email', 'contact', 'image', 'api_token')->where('email', $request->email)->first();
                    $data->totalcars = totalCars();
                    $data->totalcategories = totalCategories();
                    $data->totalusers = totalUsers();
                   
                    return response()->json([
                    'code' => '200',
                    'message' => 'Login successfully !',
                    'Data'=>$data,
                    
                ]);

            }else{
              
                return response()->json([
                    'code' => '201',
                    'message' => 'Invalid Credentials',
                ]);
                
            }
        }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
}  
      
    }

    /**
     * Reset Password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ]);
        try{
            if ($validator->fails())
            {
                return response()->json([
                    'code' => '422',
                    'message' => 'Validation Error',
                    'data' => $validator->errors()
                ]);
            }else{

                $randomString = Str::random(6);
                $input = User::where('email', $request->email)->first();
           
                $input->password = Hash::make($randomString);
                $input->save();
                $sendNotification = new EmailNotification();
                $heading = "Reset Password";
                $subject = "Your password has been successfully reset.New login Credintials are :";
                $sendNotification->login_email($input->name,$request->email,$randomString,$heading,$subject);
                    return response()->json([
                    'code' => '200',
                    'message' => 'Password successfully Resset! New Login credintials are send to the given Email !',    
                ]);


        }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        try{
            if ($validator->fails())
            {
                return response()->json([
                    'code' => '422',
                    'message' => 'Validation Error',
                    'data' => $validator->errors()
                ]);
            }else{

                $data = User::find($request->user_id);

                if($request->has('name')){
                $data->name= $request->name;
                }
                if($request->has('contact')){
                $data->contact= $request->contact;
                }
                if($request->has('email')){
                $data->email= $request->email;
                }
                if($request->hasFile('image'))
                {
                    $fileNameWithExt = $request->file('image')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $image = $fileName.'_'.time().'.'.$extension;
                    $path = $request->file('image')->storeAs('user', $image);
                    $data['image'] = $image;
                }
                $data->save();
                    return response()->json([
                    'code' => '200',
                    'message' => 'Profile info updated Successfully!',    
                    'data'=>$data,
                ]);


        }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required ',
            'new_password' => 'required|confirmed|min:6',
        ]);
        try{
            if ($validator->fails())
            {
                return response()->json([
                    'code' => '422',
                    'message' => 'Validation Error',
                    'data' => $validator->errors()
                ]);
            }else{
                $check = User::find($request->user_id);
                    #Match The Old Password
                    if(!Hash::check($request->old_password, $check->password)){
                        return response()->json([
                            'code' => '200',
                            'message' => 'Old Password Doesnt match!!',    
                        ]);

                    }
                    User::whereId($request->user_id)->update([
                        'password' => Hash::make($request->new_password)
                    ]);
                    return response()->json([
                    'code' => '200',
                    'message' => 'Password changed successfully!',    
                ]);


        }
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        }
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        try{
            if ($validator->fails()){
                return response()->json([
                    'message' => 'Validation Error',
                    'data' => $validator->errors()->first()
                ],422);
            }
          
            $user = User::where('id',$request->user_id)
                ->first();
            if($user){
                $user->api_token = '';
                $user->save();
                return response()->json([
                    'code' => '200',
                    'message' => 'Logout Successfully',    
                ]);
            }
            return response()->json([
                'code' => '201',
                'message' => 'Not Found',    
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something Went Wrong!',
                'data' => $e->getMessage(),
            ],500);
        }
    }
}
