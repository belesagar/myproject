<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Model\franchiseModel;
use Session;
use Mail; 

class ApiController extends Controller
{

    public function index() {
		return view('dashboard');
    }
	
	public function getdata(Request $request) {
		$request_data = $request->all();
		return $request_data;
    }
	
	public function login() {
		return view("admin.login");
    }
	
	public function signup() {
		return view("signup");
    }
	
	public function checkSignup(Request $request) {
		$request_data = $request->all();
		return $request_data['name'];
    }

    public function checkUser(Request $request) {
		dd($request);
    }
}
