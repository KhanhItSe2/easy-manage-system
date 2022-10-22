<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function dashboard(Request $request)
    {
        $userId = $request->userId;
        $password = password_hash($request->password, PASSWORD_DEFAULT);


        $result = DB::table('users')->where('EMPID', $userId)->where('password', password_verify($password, 'password'))->first();
        if ($result) {
            Session::put('USERNAME', $result->USERNAME);
            Session::put('ID', $result->ID);
            if ($result->ROLEID === '1') {
                return view('admin.Account.account');
            } else if ($result->ROLEID === '2') {
                return view('welcome');
            } else {
                return view('welcome');
            }
        } else {
            Session::put('message', 'Your ID or Password are incorrect!');

            return Redirect::to('welcome');
        }
    }
    public function logout()
    {
        return view('welcome');
    }
}
