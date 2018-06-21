<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\dashboardModel;
use Session;
use DB;

class DashboardController extends Controller
{
	public function __construct()
    {
         $this->dashboardModel = new dashboardModel();
         $this->sessionName = \Config::get('constant.SESSION_NAME');
    }

    public function index(Request $request) {

		return view('admin.dashboard');
    }

    public function profile(Request $request) {

    	$admin_user_id = session($this->sessionName)['admin_user_id'];

    	$postData = array(
    		"admin_user_id" => $admin_user_id
    	);

    	$userData =  $this->dashboardModel->getAdminUserData($postData);
    	
		return view('admin.profile', ['result_data' => $userData]);
    }

    public function updateProfile(Request $request) {

    	$validator = \Validator::make($request->all(),[
          'first_name' => 'required|string',
          'last_name' => 'required|string',
          'alternet_mobile_no' => 'nullable|numeric',
       ]); 
       
        if ($validator->fails()) {
        	// send back to the page with the input data and errors
        	return redirect("profile")->withErrors($validator, 'errormsg')->withInput();
        }

        $request_data = $request->all();

        $admin_user_id = session($this->sessionName)['admin_user_id'];

        $responce = DB::table("admin_user")->where('admin_user_id',$admin_user_id)->update([
        	"first_name" => $request_data['first_name'],
        	"last_name" => $request_data['last_name'],
        	"alternet_mobile_no" => $request_data['alternet_mobile_no']
        ]);
        
        // if($responce)
        // {
        	Session::flash('success_message', "Data is successfully updated.");
            
        // }else{
        // 	Session::flash('error_message', "Something wrong with data, please try again.");
        // }

    	return redirect()->back();
    }

    public function changePassword(Request $request) {
		return view('admin.change_password');
    }

    public function setChangePassword(Request $request) {
    	$validator = \Validator::make($request->all(),[
          'old_password' => 'required|min:5',
          'new_password' => 'required|min:5',
          'reenter_password' => 'required|min:5|same:new_password',
       ]); 
       
        if ($validator->fails()) {
        	// send back to the page with the input data and errors
        	return redirect("change_password")->withErrors($validator, 'errormsg')->withInput();
        }

        $request_data = $request->all();

        $admin_user_id = session($this->sessionName)['admin_user_id'];

        $postData = array(
    		"admin_user_id" => $admin_user_id
    	);

    	$userData =  $this->dashboardModel->getAdminUserData($postData);

    	if($userData[0]->password == md5($request_data['old_password']))
    	{
    		$responce = DB::table("admin_user")->where('admin_user_id',$admin_user_id)->update([
	        	"password" => md5($request_data['new_password'])
	        ]);
	        
	        // if($responce)
	        // {
	        	Session::flash('success_message', "Password is successfully updated.");
	            
	        // }else{
	        // 	Session::flash('error_message', "Something wrong with data, please try again.");
	        // }
    	}else{
    		Session::flash('error_message', "Your old password is wrong, please enter right password.");
    	}

        return redirect()->back();
    }

}
