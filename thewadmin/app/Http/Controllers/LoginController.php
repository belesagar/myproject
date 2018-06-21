<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\loginModel;
use Session;
use Mail;
use Cookie;

class LoginController extends Controller
{

    public function __construct()
    {
         $this->login = new loginModel();
         $this->sessionName = \Config::get('constant.SESSION_NAME');
    }

    public function index() {
		    return view('admin.login');
    }

    public function login() {
        return view('admin.login');
    }

    public function getLoginData(Request $request) {

        $validator = \Validator::make($request->all(),[
          'email' => 'required|email',
          'password' => 'required|min:5',
       ]); 
       
        if ($validator->fails()) {
          // send back to the page with the input data and errors
          return redirect("login")->withErrors($validator, 'login')->withInput();
        }

        $request_data = $request->all();

        $postData = array(
            "email" => $request_data['email'],
            "password" => md5($request_data['password'])
        );

        $checkUser =  $this->login->getLoginData($postData);
        
        if($checkUser->count() == 1)
        {
            if($checkUser[0]->is_active == '1')
            {   
                $sessionData = array(
                    "admin_user_id" => $checkUser[0]->admin_user_id,
                    "first_name" => $checkUser[0]->first_name,
                    "last_name" => $checkUser[0]->last_name,
                    "email" => $checkUser[0]->email,
                    "is_active" => $checkUser[0]->is_active,
                );
               
                $request->session()->put($this->sessionName, $sessionData);
                return redirect('dashboard');
            }else{
              Session::flash('error_message', "Your account is not activated, please contact to admin.");
              return redirect()->back();
            }
        }else{
            Session::flash('error_message', "Invalid Credentials");
            return redirect()->back();
        }
      
    }

   
    public function logout(Request $request) {
    	$request->session()->forget($this->sessionName); 
		  return redirect('login');
    }


    public function checkExist(Request $request) {
        
        $responce = \Helpers::getDataFromApi("franchise_registration/checkExist",$request->all());
        
        if($responce['ERROR_CODE'] == 0)
         {
            return 'true';
         }else{
            return 'false';
         }


        /*
        if(isset($request->email))
        {
            $validator = \Validator::make($request->all(),[
              'email' => 'unique:tbl_fastbanking_franchise,email',
           ]); 
           
            if ($validator->fails()) {
                return 'false';
            }else{
                return 'true';
            }
        }

        if(isset($request->mobile))
        {
            $validator = \Validator::make($request->all(),[
              'mobile' => 'unique:tbl_fastbanking_franchise,mobile',
           ]); 
           
            if ($validator->fails()) {
                return 'false';
            }else{
                return 'true';
            }
        }
        */
    }

    public function getSignupData(Request $request) {


         $responce = \Helpers::getDataFromApi("franchise_registration/franchise_user_signup",$request->all());
         
         if($responce['ERROR_CODE'] == 0)
         {
            
            Session::flash('success_message', 'Sign up process is completed, Please log in.');
            return redirect("login");
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect("login#signup")->withInput($request->input());
         }

        
        /*
    	//This code for validation
    	$validator = \Validator::make($request->all(),[
          'first_name' => 'required|string',
          'last_name' => 'required|string',
          'email' => 'required|email|unique:tbl_fastbanking_franchise,email',
          'password' => 'required|min:4',
          'cpassword' => 'required|min:4|same:password',
          'mobile' => 'required|integer|unique:tbl_fastbanking_franchise,mobile',
          
       ]); 
       
        if ($validator->fails()) {
        	// send back to the page with the input data and errors
        	return redirect("login#signup")->withErrors($validator, 'login')->withInput();
        }else{
        	$validator = \Validator::make($request->all(),[
	          'agree' => 'required',
	       ]);

        	if ($validator->fails()) {
	        	// send back to the page with the input data and errors
	        	return redirect("login#signup")->withErrors($validator, 'login')->withInput();
        	}

        }

       
        //This code for Create instance of Frenchise model
        $franchiseModel = new franchiseModel();

        //This code for storing data in the frenchise table
        $add_data = array(
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "email" => $request->email,
                "mobile" => $request->mobile,
        ); 

        $responcedata = $franchiseModel->storeFranchiseData($add_data);

        if($responcedata != "false")
        {
            //This code for storing data in the frenchise user table
        	$add_data['login_password'] = md5($request->password);
        	$add_data['franchise_id'] = $responcedata;

        	$responcedata = $franchiseModel->storeFranchiseUserData($add_data);

        }else{
        	Session::flash('error_message', 'Something went wrong please try again.');
        	return redirect("login#signup");
        }
 
		Session::flash('success_message', 'Sign up process is done.');
        return redirect("login");
        */
    }

    //This code for forgot password
    public function getForgotPasswordData(Request $request) {

        $responce = \Helpers::getDataFromApi("channel_partner_registration/forgot_password",$request->all());
        // dd($responce);
         if($responce['ERROR_CODE'] == 0) 
         {
            
            Session::flash('success_message', $responce['ERROR_DESCRIPTION']);
            return redirect("login#forgot");
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect("login#forgot")->withInput($request->input());
         }

       
    }

    //This code for forgot password
    public function resetPassword($code="") {
        

      $data = array();

        if($code != "")
        {
            $reset_code = array(
                "reset_code" => $code
            );

             $responce = \Helpers::getDataFromApi("channel_partner_registration/check_reset_code",$reset_code);

             if($responce['ERROR_CODE'] == 0) 
             {
                
                Session::flash('success_message', $responce['ERROR_DESCRIPTION']);  
                return view('admin.reset_password',["reset_code" => $code]);
             }else{
                Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
                return redirect("login#forgot");
             }
        }

    }

    public function getResetPasswordData(Request $request) {
        
        

        $responce = \Helpers::getDataFromApi("channel_partner_registration/reset_password_data",$request->all());

         if($responce['ERROR_CODE'] == 0) 
         {
            
            Session::flash('success_message', $responce['ERROR_DESCRIPTION']);
            return redirect("login");
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect("login#forgot")->withInput($request->input());
         }
    }

    public function sendOtp(Request $request) {
 

        //dd(json_encode($request->all()));

        $request_data = $request->all();

        // $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['to'] = "send";
        
        $response = array();

        $responce = \Helpers::getDataFromApi("franchise_registration/sendotp",$request_data);

        return $responce; 

    }

    public function verify_otp(Request $request) {
        print_r($request->all());  
        exit;
    }


}
