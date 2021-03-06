<?php

namespace App\Http\Controllers\Api;

use App\Countries;
use App\Http\Controllers\Controller;
use App\repo\Response;
use App\States;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function getCountries()
    {
        $data = Countries::select('id', 'name')->where("status", "Active")->get();
        $msg = "Countries fetch successfully.";
        return Response::Success($data, $msg);
    }
    public function getStates($id)
    {
        $data = States::select('id', 'name', 'country_id')->where("country_id", $id)->where("status", "Active")->get();
        $msg = "States fetch successfully.";
        return Response::Success($data, $msg);
    }
    public function signup(Request $request)
    {
        $msg = [
            'name.required' => 'Enter Name.',
            'username.required' => 'Enter Username.',
            'username.unique' => 'Username already taken.',
            'email.required' => 'Enter Email.',
            'email.unique' => 'Email already exist.',
            'phone.required' => 'Enter Phone Number.',
            'user_type.required' => 'Select account type.',
            'password.required' => 'Enter password.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required',
            'user_type' => 'required'
        ], $msg);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $data = $request->all();
                $data["password"] = bcrypt($request->get('password'));
                $data["api_token"] = Str::random(60);

                // $data["otp"] = mt_rand(100000, 999999);
                $data["otp"] = 123456;
                $user = User::create($data);
                $msg = 'Registration successful! Please see your Inbox or Junk mail folder for a confirmation email from info@zytrio.com and follow the email instructions to activate your account.';
                DB::commit();
                $data = $user;
                return Response::Success($data, $msg);
            } catch (Exception $e) {
                $data = [];
                $msg = 'Registration Failed.';
                DB::rollback();
                return Response::Error($data, $msg);
            }
        } else {
            $data = [];
            $msg = $validator->errors()->first();
            return Response::Error($data, $msg);
        }
    }

    public function verifyAccount(Request $request)
    {
        $otp = $request->get('otp');
        $token = $request->get('api_token');
        try {
            if ($otp != '') {
                $user_otp = User::where('api_token', $token)->value('otp');
                // $otp=mt_rand(100000, 999999);
                $otp = 123456;
                if ($user_otp == $otp) {
                    User::where('api_token', $token)->update([
                        'otp' =>  $otp,
                        'status' =>  'Active'
                    ]);
                    $data = ['token' => $token];
                    $msg =  'Your account is verify successfully, now you can login.';
                    return Response::Success($data, $msg);
                } else {
                    $data = [];
                    $msg =  'Otp Not Matched.';
                    return Response::Error($data, $msg);
                }
            } else {
                $data = [];
                $msg =  'Enter Your otp.';
                return Response::Error($data, $msg);
            }
        } catch (Exception $e) {
            $data = [];
            $msg =  'Failed.';
            return Response::Error($data, $e->getMessage());
        }
    }

    public function signin(Request $request)
    {
        $msg = [
            'email.required' => 'Enter Your Email or Phone No.',
            'password.required' => 'Enter Your Password.',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required',
            'password' => 'bail|required|alphaNum|min:6'

        ], $msg);
        if ($validator->passes()) {
            $email = $request->get('email');
            $pass = $request->get('password');
            $user = User::where('email', $email)->first();
            $remember_me = $request->has('remember') ? true : false;
            try {
                if ($user != null) {
                    if (Hash::check($pass, $user->password)) {
                        if ($user->hasRole(['teacher']) == true) {
                            if (Auth::attempt(array('email' => $email, 'password' => $pass, 'status' => 'Active'), $remember_me)) {
                                $msg = 'Login Successfully !!!.';
                                $data = Auth::user();
                                return Response::Success($data, $msg);
                            } else {
                                $msg = 'Login Failed !!! Your Account is not verified.Please contact to admin.';
                                $data = [];
                                return Response::Error($data, $msg);
                            }
                        } else {
                            $msg = 'Login Failed !!! Please check Your Email and Password.';
                            $data = [];
                            return Response::Error($data, $msg);
                        }
                    } else {
                        $msg = 'Password Not Matched.';
                        $data = [];
                        return Response::Error($data, $msg);
                    }
                } else {
                    $msg = 'Email Not Exists.';
                    $data = [];
                    return Response::Error($data, $msg);
                }
            } catch (Exception $e) {
                $msg = 'Login Failed !!! Please check Your Email and Password.';
                $data = [];
                return Response::Error($data, $msg);
            }
        } else {
            $msg = $validator->errors()->first();
            $data = [];
            return Response::Error($data, $msg);
        }
    }

    public function forgetPassword(Request $request)
    {
        $msg = [
            'email.required' => 'Enter Your Email.',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], $msg);
        if ($validator->passes()) {

            $email = $request->get('email');
            try {
                $check_email = User::where('email', $email)->count();
                if ($check_email == 1) {
                    // $otp = mt_rand(100000, 999999);
                    $otp = 123456;
                    $user = User::where('email', $email)->first();
                    $name = $user->name;
                    $api_token = User::where('email', $email)->value('api_token');
                    if ($api_token != '') {
                        User::where('id', $user->id)->update([
                            'otp' => $otp
                        ]);
                        $data = ['token' => $api_token];
                        $msg =  'Please check your mail to get otp.';
                        return Response::Success($data, $msg);
                    } else {
                        $data = [];
                        $msg =  'Token Not Found.';
                        return Response::Error($data, $msg);
                    }
                } else {
                    $data = [];
                    $msg =  ' Email Not valid.';
                    return Response::Error($data, $msg);
                }
            } catch (Exception $e) {
                $data = [];
                $msg =  'Failed.';
                return Response::Error($data, $msg);
            }
        } else {
            $msg = $validator->errors()->first();
            $data = [];
            return Response::Error($data, $msg);
        }
    }

    public function checkOtp(Request $request)
    {
        $otp = $request->get('otp');
        $token = $request->get('api_token');
        try {
            if ($otp != '') {
                $user_otp = User::where('api_token', $token)->value('otp');
                if ($user_otp == $otp) {
                    // $otp = mt_rand(100000, 999999);
                    $otp = 123456;
                    User::where('api_token', $token)->update([
                        'otp' =>  $otp,
                        'status' =>  'Active'
                    ]);
                    $data = ['token' => $token];
                    $msg =  'Otp Matched.';
                    return Response::Success($data, $msg);
                } else {
                    $data = [];
                    $msg =  'Otp Not Matched.';
                    return Response::Error($data, $msg);
                }
            } else {
                $data = [];
                $msg =  'Enter Your otp.';
                return Response::Error($data, $msg);
            }
        } catch (Exception $e) {
            $data = [];
            $msg =  'Failed.';
            return Response::Error($data, $e->getMessage());
        }
    }

    public function resetPassword(Request $request)
    {
        $msg = [
            'n_password.required' => 'Enter Your New Password.',
            'c_password.required' => 'Enter Your Confirm Password.',
        ];
        $validator = Validator::make($request->all(), [
            'n_password' => 'required',
            'c_password' => 'required',
        ], $msg);
        if ($validator->passes()) {
            try {
                $n_password = $request->get('n_password');
                $c_password = $request->get('c_password');
                $token = $request->get('api_token');
                $otp = mt_rand(100000, 999999);
                $otp = 123456;
                if ($n_password == $c_password) {
                    User::where('api_token', $token)->update([
                        'password' => bcrypt($n_password),
                        'otp' => $otp,
                    ]);
                    $data = ['api_token' => $token];
                    $msg = 'Password Updated Successfully';
                    return Response::Success($data, $msg);
                } else {
                    $data = [];
                    $msg = 'New Password and Confirm not matched.';
                    return Response::Error($data, $msg);
                }
            } catch (Exception $e) {
                $data = [];
                $msg = 'Failed.';
                return Response::Error($data, $msg);
            }
        } else {
            $data = $validator->errors()->first();
            $msg = 'Password Reset Failed.';
            return Response::Error($data, $msg);
        }
    }
}
