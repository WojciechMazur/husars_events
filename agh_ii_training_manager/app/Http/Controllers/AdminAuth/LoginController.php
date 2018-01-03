<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/admin/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth/admin/login');
    }

    protected function guard()
    {
        return Auth::guard('web_admin');
    }

}
