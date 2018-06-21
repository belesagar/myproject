<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\employeeModel;
use Session;
use DB;
use validator;

class EmployeeController extends Controller
{
    public function __construct()
    {
         $this->employeeModel = new employeeModel();
         $this->sessionName = \Config::get('constant.SESSION_NAME');
    }

    public function index(Request $request) {

    	//This function for getting employee data
    	$employeeData =  $this->employeeModel->getEmployeeListData();
    	
		return view('admin.employee.employee_list',['result_data'=>$employeeData]);
    }

    public function add(Request $request) {
    	return view('admin.employee.add_employee');
    }
    
    public function add_data(Request $request) {

    	$request_data = $request->all();

    	$validator = \Validator::make($request->all(),[
          'first_name' => 'required|string',
          'last_name' => 'required|string',
          'email' => 'required|email',
          'mobile' => 'required|numeric',
          'alternet_mobile_no' => 'nullable|numeric',
          'address_line1' => 'required',
          'pincode' => 'nullable|numeric',
          'is_active' => 'required|numeric',
          // 'role' => 'required',
       ]); 
       
        if ($validator->fails()) {
        	// dd($validator->errors()->messages());
        	// send back to the page with the input data and errors
        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
        }

        $responce = DB::table("admin_user")->insert([
	        	"first_name" => $request_data['first_name'],
	        	"last_name" => $request_data['last_name'],
	        	"email" => $request_data['email'],
	        	"mobile" => $request_data['mobile'],
	        	"alternet_mobile_no" => $request_data['alternet_mobile_no'],
	        	"address_line1" => $request_data['address_line1'],
	        	"address_line2" => $request_data['address_line2'],
	        	"pincode" => $request_data['pincode'],
	        	"is_active" => $request_data['is_active'],
	        	// "role" => $request_data['role'],
	        	"created_at" => date("Y-m-d h:i:s"),
	        ]);
	        
	        
	   Session::flash('success_message', "Employee is successfully added.");

    	return redirect()->route('employeelist');
    }

    public function edit(Request $request,$id) {

    	$postData = array(
    		"admin_user_id" => $id
    	);

    	$employeeData =  $this->employeeModel->getEmployeeData($postData);

    	if($employeeData->count() == 1)
    	{
    		return view('admin.employee.edit_employee',['result_data'=>$employeeData]);
    	}else{
    		Session::flash('error_message', "Invalid Employee.");
    		return redirect()->back();
    	}
    }

    public function update(Request $request) {

    	$request_data = $request->all();

    	$validator = \Validator::make($request->all(),[
          'first_name' => 'required|string',
          'last_name' => 'required|string',
          'email' => 'required|email',
          'mobile' => 'required|numeric',
          'alternet_mobile_no' => 'nullable|numeric',
          'address_line1' => 'required',
          'pincode' => 'nullable|numeric',
          'is_active' => 'required|numeric',
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

        	$employeeData =  $this->employeeModel->checkEmployeeEmail($postData);

        	if($employeeData->count() != 0)
	        {
	        	if($employeeData[0]->admin_user_id != $request_data['admin_user_id'])
		        {
					$validator->errors()->add('email', 'Email already exists');
		        	return redirect()->back()->withErrors($validator, 'errormsg')->withInput();
		        }
	        }

        }

        $responce = DB::table("admin_user")->where('admin_user_id',$request_data['admin_user_id'])->update([
	        	"first_name" => $request_data['first_name'],
	        	"last_name" => $request_data['last_name'],
	        	"email" => $request_data['email'],
	        	"mobile" => $request_data['mobile'],
	        	"alternet_mobile_no" => $request_data['alternet_mobile_no'],
	        	"address_line1" => $request_data['address_line1'],
	        	"address_line2" => $request_data['address_line2'],
	        	"pincode" => $request_data['pincode'],
	        	"is_active" => $request_data['is_active'],
	        	// "role" => $request_data['role'],
	        ]);
	        
	        
	   Session::flash('success_message', "Employee is successfully updated.");

    	return redirect()->route('employeelist');
    }

}
