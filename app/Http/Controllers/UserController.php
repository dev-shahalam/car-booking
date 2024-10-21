<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Car;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {
    // Register Page
    public function registerPage() {
        return view('pages.auth.register');
    }
    //Login Page
    public function loginPage() {
        return view('pages.auth.login');
    }
    //Send Email Page
    public function sendEmailPage() {
        return view('pages.auth.send-otp');
    }
    //Submit Otp Page
    public function submitOtpPage() {
        return view('pages.auth.submit-otp');
    }

    //Forgot Password Page
    public function changePasswordPage() {
        return view('pages.auth.change-password');
    }
    // Admin Dashboard Page
    public function adminDashboard(Request $request) {
        $email = $request->headers->get('email');
        $role = $request->headers->get('role');

        $admin = User::where('email', $email)->first();
        if ($admin && $role == 'admin') {
            return view('admin.dashboard-page', compact('admin'));
        }
        return redirect()->route('login')->with('error', 'You are not authorized to access this page');
    }

    // Admin Profile Page
    public function adminProfile(Request $request) {
        $email = $request->header('email');
        $role = $request->header('role');
        $user_id = $request->header('id');

        $admin = User::where('email', $email)->where('id', $user_id)->first();
        if ($admin && $role == 'admin') {
            return view('components.dashboard.profile-form', compact('admin'));
        }
        return redirect()->route('login')->with('error', 'You are not authorized to access this page');
    }

    // Customer Dashboard Page
    // public function userDashboard(Request $request) {
    //     $email = $request->headers->get('email');
    //     $role = $request->headers->get('role');
    //     $user = User::where('email', $email)->first();
    //     if ($user && $role == 'customer') {
    //         return view('user.home',compact('user'));
    //         // return view('user.home')->with('user', $user);
    //     }
    //     return redirect()->route('homepage')->with('error', 'You are not authorized to access this page');
    // }


    public function homePage(){
        // $user = User::all();
        // $cars= Car::paginate( );
        $cars= Car::paginate(3);
        return view('user.home',compact('cars'));
    }







    // public function genarelUser(Request $request){
    //     $email = $request->header('email');
    //     $user = User::where('email', $email)->first();
    //     if($user){
    //         return view('user.home',compact('user'));
    //     }
    //     return view('user.home');
    // }








    // Register Controller
    public function registerUser(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required | email | unique:users,email',
                'password' => 'required',
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
            ]);

            if ($user) {
                return redirect()->route('login')->with('success', 'User Created Successfully');
            } else {
                return redirect()->back()->with('error', 'Something is wrong');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    // Admin Update Controller
    public function updateAdminProfile(Request $request) {
        $admin_id = $request->header('id');
        $role = $request->header('role');

        $admin = User::findOrFail($admin_id);
        if ($admin && $role == 'admin') {

            $name = $request->input('name');
            $email = $request->input('email');
            $phone_number = $request->input('phone_number');
            $address = $request->input('address');

            if ($admin->name == $name && $admin->email == $email && $admin->phone_number == $phone_number && $admin->address == $address) {
                return redirect()->back()->with('error', 'Here is nothing to update');
            } else {
                $admin->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
                    'address' => $request->input('address'),
                ]);
                return redirect()->back()->with('success', 'Request Successfull');
            }

        } else {
            return redirect()->back()->with('error', 'Please try again later');
        }

    }

    // Login Controller
    public function loginUser(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $admin = User::where('email', $email)->first();

        if ($admin && Hash::check($password, $admin->password)) {
            if ($admin->role == 'admin') {
                $token = JWTToken::CreateToken($admin->email, $admin->id, 'admin');
                return redirect()->route('dashboard')->cookie('token', $token, 3600);
            } elseif ($admin->role == 'customer') {
                $token = JWTToken::CreateToken($admin->email, $admin->id, 'customer');

                return redirect()->route('home')->with('user',$admin)->cookie('token', $token, 3600);
            } else {
                return redirect()->back()->withErrors(['login' => 'Invalid email or password.'])->withInput();
            }
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid email or password.'])->withInput();
        }
    }

    // Logout Controller
    public function logout(Request $request) {

        $user_id=$request->header('id');
        $user=User::where('id',$user_id)->first();
        if($user && $user->role == 'customer'){
            return redirect()->route('home')->cookie('token', null, -1);
        }
        else if($user && $user->role == 'admin'){
            return redirect()->route('login')->cookie('token', null, -1);
        }
        else{
            return redirect()->back()->with('error', 'Something is wrong');
        }
    }


    // Send OTP Controller
    public function sendOtp(Request $request) {
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->otp = $otp;
            $user->save();
            Mail::to($user->email)->send(new OtpMail($otp, $user));

            return redirect()->route('submit-otp')->with('success', 'OTP sent successfully');
        } else {
            return redirect()->back()->with('error', 'Something is wrong');
        }
    }

    // Submit OTP Controller
    public function submitOtp(Request $request) {
        $otp = $request->input('otp');
        $user = User::where('otp', $otp)->first();
        if ($user) {
            $user->otp = null;
            $user->save();
            return redirect()->route('change-password')->with('success', 'OTP verified successfully')
                ->withCookie('email', $user->email, 3600);
        } else {
            return redirect()->back()->with('error', 'Something is wrong');
        }
    }

    // Change Password Controller
    public function changePassword(Request $request) {
        try {
            $password = bcrypt($request->input('password'));
            $email = $request->cookie('email');

            $user = User::where('email', $email)->first();
            if ($user) {
                $user->update(['password' => $password]);
                return redirect()->route('login')->with('success', 'Password changed successfully')
                    ->cookie('email', null, -1);
            } else {
                return redirect()->back()->with('error', 'Something is wrong');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}


