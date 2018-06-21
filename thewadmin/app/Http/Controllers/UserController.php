<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\usersModel;
use Session;
use DB;
use validator;

class UserController extends Controller
{
    public function __construct()
    {
         $this->usersModel = new usersModel();
         $this->sessionName = \Config::get('constant.SESSION_NAME');
    }

    public function index(Request $request) {

    	$search_cond = array(
            'name' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile'
        );

		return view('admin.users.user_list',["search_cond" => $search_cond]);
    }
    
    public function getUserListDataByAjax(Request $request) {

    	$request_data = $request->all();
    	$postData = array(
            "search_cond" => $request_data['search_cond'],
            "searchfield" => $request_data['searchfield'],
            "length" => $request_data['length'],
            "offset" => $request_data['start'],
            "fromdate" => $request_data['fromdate'],
            "todate" => $request_data['todate'],
        );

    	$whereData = array();

    	if($postData['searchfield'] != "")
    	{
	  		if($postData['search_cond'] == "name")
	  		{
	  			$whereData[] = ['name', 'like', $postData['searchfield']];
	  		}

	  		if($postData['search_cond'] == "email")
	  		{
	  			$whereData[] = ['email', 'like', $postData['searchfield']];
	  		}	

	  		if($postData['search_cond'] == "mobile")
	  		{
	  			$whereData[] = ['mobile', $postData['searchfield']];
	  		}
  		}

  		$postData["whereData"] = $whereData;
  	
    	$result_data =  $this->usersModel->getUsersListData($postData);

    	$result_data_count =  $this->usersModel->getUsersDataCount($postData);

    	$dataarray = array();

    	$dataarray['recordsTotal'] = $result_data_count;
        $dataarray['recordsFiltered'] = $result_data_count;
        $dataarray['data'] = $result_data;

    	print_r(json_encode($dataarray)); 
    	exit;
	}

	public function add(Request $request) {
    	return view('admin.users.add_user');
    }

    public function add_data(Request $request) {

    	$request_data = $request->all();

    	$validator = \Validator::make($request->all(),[
          'name' => 'required|string',
          'email' => 'email',
          'mobile' => 'required|numeric|unique:users,mobile',
          'alternet_mobile_no' => 'nullable|numeric',
          'address_line1' => 'required',
          'pincode' => 'nullable|numeric',
          // 'is_active' => 'required|numeric',
          // 'role' => 'required',
       ]); 
       
        if ($validator->fails()) {
        	// dd($validator->errors()->messages());
        	// send back to the page with the input data and errors
        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }

        $responce = DB::table("users")->insert([
	        	"name" => $request_data['name'],
	        	"email" => $request_data['email'],
	        	"mobile" => $request_data['mobile'],
	        	"alternet_mobile_no" => $request_data['alternet_mobile_no'],
	        	"address_line1" => $request_data['address_line1'],
	        	"address_line2" => $request_data['address_line2'],
	        	"pincode" => $request_data['pincode'],
	        	// "is_active" => $request_data['is_active'],
	        	// "role" => $request_data['role'],
	        	"created_at" => date("Y-m-d h:i:s"),
	        ]);
	        
	        
	   Session::flash('success_message', "User is successfully added.");

    	return redirect()->route('userslist');
    }

    public function edit(Request $request,$id) {

    	$postData = array(
    		"id" => $id
    	);

    	$userData =  $this->usersModel->getUserData($postData);

    	if($userData->count() == 1)
    	{
    		return view('admin.users.edit_user',['result_data'=>$userData]);
    	}else{
    		Session::flash('error_message', "Invalid Employee.");
    		return redirect()->back();
    	}
    }

    public function update(Request $request) {

    	$request_data = $request->all();

    	$validator = \Validator::make($request->all(),[
          'name' => 'required|string',
          'email' => 'required|email',
          'mobile' => 'required|numeric',
          'alternet_mobile_no' => 'nullable|numeric',
          'address_line1' => 'required',
          'pincode' => 'nullable|numeric',
          // 'is_active' => 'required|numeric',
          // 'role' => 'required',
          "updated_at" => date("Y-m-d h:i:s"), 
       ]); 
       
        if ($validator->fails()) {
        	// dd($validator->errors()->messages());
        	// send back to the page with the input data and errors
        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }else{
        	$postData = array(
    			"email" => $request_data['email']
    		);

        	$userData =  $this->usersModel->checkUserEmail($postData);

        	if($userData->count() != 0)
	        {
	        	if($userData[0]->id != $request_data['id'])
		        {
					$validator->errors()->add('email', 'Email already exists');
		        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
		        }
	        }

        }

        $responce = DB::table("users")->where('id',$request_data['id'])->update([
	        	"name" => $request_data['name'],
	        	"email" => $request_data['email'],
	        	"mobile" => $request_data['mobile'],
	        	"alternet_mobile_no" => $request_data['alternet_mobile_no'],
	        	"address_line1" => $request_data['address_line1'],
	        	"address_line2" => $request_data['address_line2'],
	        	"pincode" => $request_data['pincode'],
	        	// "is_active" => $request_data['is_active'],
	        	// "role" => $request_data['role'],
	        ]);
	        
	        
	   Session::flash('success_message', "User is successfully updated.");

    	return redirect()->route('userslist');
    }

    public function view(Request $request,$id) {

    	$postData = array(
    		"id" => $id
    	);

    	$userData =  $this->usersModel->getUserData($postData);
    	
    	if($userData->count() == 1)
    	{
    		return view('admin.users.user_view',['result_data'=>$userData]);
    	}else{
    		Session::flash('error_message', "Invalid Employee.");
    		return redirect()->back();
    	}
    }

}
