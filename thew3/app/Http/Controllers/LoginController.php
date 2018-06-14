<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\franchiseModel;
use App\users;
use Session;
use Mail; 

class LoginController extends Controller
{

    public function index() {
		return view('dashboard');
    }
	
	public function getdata() {
		return view("admin.home");
    }
	
	public function login() {
		return view("admin.login");
    }
	
	public function signup() {
		return view("signup");
    }
	
	public function checkSignup(Request $request) {
		$request_data = $request->all();

		$users_data = App\users::all();

		return $users_data;
    }
}
