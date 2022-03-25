<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auth_Admin;
use App\Models\Auth_Users;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Controller_Login extends Controller
{
    public function update_passwd(Request $request)
    {
        $id = $_GET['id'];
        $newPass = $request->input('new-password');
        DB::table('users')->where('user_id', '=', $id)->update(['user_password' => md5($newPass)]);

        return redirect()->back()->with('message', 'Your password is updated!');
    }
    public function handle_register_admin(Request $request)
    {
        $data = array();
        $data['admin_name'] = $request->admin_name;
        $data['admin_email'] = $request->admin_email;
        $data['admin_password'] = md5($request->admin_password);

        $admin_id = DB::table('admin')->insertGetId($data);

        Session::put('admin_id', $admin_id);
        Session::put('admin_name', $request->admin_name);

        return redirect('/dashboard');
    }
    public function handle_login_admin(Request $request)
    {
        $email = $request->input('admin_email');
        $password = md5($request->input('admin_password'));

        $req_login = Auth_Admin::where('admin_email', $email)->where('admin_password', $password)->first();

        if ($req_login) {
            Session::put('admin_id', $req_login->admin_id);
            Session::put('admin_name', $req_login->admin_name);

            return redirect('/dashboard');
        } else {
            Session::flash('error', 'Email or password does not matched!');
            return redirect('/admin-login');
        }
    }
    public function Logout_admin()
    {
        Session::flush();
        return redirect('/admin-login');
    }
    public function register_user(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $rules = [
            'user_fullname' => 'required|max:125',
            'user_phonenumber' => 'required|digits:10',
            'user_email' => 'required|max:125|email',
            'user_password' => 'required|min:6'
        ];

        $messages = [
            'user_fullname.required' => 'Please enter your name!',
            'user_phonenumber.required' => 'Please enter your phone number!',
            'user_email.required' => 'Please enter your email!',
            'user_password.required' => 'Please enter your password!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('/register-account')->withErrors($validator)->withInput();
        } else {

            $data = array();
            $data['user_name'] = $request->user_fullname;
            $data['user_email'] = $request->user_email;
            $data['user_phone'] = $request->user_phonenumber;
            $data['user_password'] = md5($request->user_password);

            $user_id = DB::table('users')->insertGetId($data);

            Session::put('user_id', $user_id);
            Session::put('user_name', $request->user_fullname);

            return redirect('/');
        }
    }

    public function login_user(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $rules = [
            'user_email' => 'required|max:125|email',
            'user_password' => 'required|min:6'
        ];
        $messages = [
            'user_email.required' => 'Please enter your email',
            'user_password.required' => 'Please enter your password',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
            return redirect('/login-account')->withErrors($validator)->withInput();
        } else {
            // Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
            $email = $request->input('user_email');
            $password = md5($request->input('user_password'));
            $req_login = Auth_Users::where('user_email', $email)->where('user_password', $password)->first();

            if ($req_login) {
                // Kiểm tra đúng email và mật khẩu sẽ chuyển trang
                Session::put('user_id', $req_login->user_id);
                Session::put('user_name', $req_login->user_name);
                if (Session::get('cart')) {
                    return redirect('/checkout-form');
                } else {
                    return redirect('/');
                }
            } else {
                // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
                Session::flash('error', 'Email or password does not matched!');
                return redirect('/login-account');
            }
        }
    }
    public function logout_user()
    {
        Session::flush();
        return redirect('/');
    }
}
