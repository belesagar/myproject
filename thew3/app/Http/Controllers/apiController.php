<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Validator;
use App\Model\userModel;
use App\Model\orderModel;
use App\Model\servicesModel;
use JWTAuth;
use JWTFactory; 
// use Session;

class apiController extends Controller
{
    public function __construct()
    {
         $this->user = new userModel();
         $this->orderModel = new orderModel();
         $this->servicesModel = new servicesModel();
    }

    public function getLoginData(Request $request) {

        $return = array(); 
        $errors_message = "";
    	$request_data = $request->all();
       
       //This for validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'mobile' => 'required|numeric', 
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $key => $value) {
                $errors_message .= $value."\n";
            }

            $return['DATA'] = '';
            $return['ERROR_CODE'] = '2';
            $return['ERROR_DESCRIPTION'] = $errors_message;
        }else{

            $postData = array(
                "name" => $request_data['name'],
                "mobile" => $request_data['mobile']
            );
            //This code for getting data of user
            $checkUser =  $this->user->checkUser($postData);

            if(count($checkUser) == 0)
            {
                $id =  $this->user->insertUserData($postData);
            }else{
                $id = $checkUser[0]->id;
            }

            //This code for creating token
            $payload = JWTFactory::sub(123)->aud('userData')->userData(['id' => $id])->make();
            $token = JWTAuth::encode($payload)->get();

            //This code update data
            $updateData = array(
                    "api_token" => $token,
                );

            $checkUser =  $this->user->updateUserData($id,$updateData);

            //This code for storing data in session
            $sesionData = array(
                "login_token" => $token,
                "user_id" => $id,
            );

            $request->session()->put('thew_session', $sesionData);
         
            $return['DATA'] = $token;
            // $return['session'] = $request->session()->get('thew_session'); 
            $return['ERROR_CODE'] = '0';
            $return['ERROR_DESCRIPTION'] = '';
        }

        return json_encode($return);

    }

    public function logout(Request $request) {

        $return = array();

        // if ($request->session()->has('thew_session')) {
            $request->session()->forget('thew_session');
        // }

        $return['DATA'] = "";
        $return['ERROR_CODE'] = '0';
        $return['ERROR_DESCRIPTION'] = '';

        return $return; 

    }

    public function verifyOtp(Request $request) {

        $return = array();

        $request_data = $request->all();
       
        // if (session()->has('temp_user_details')) {
            
            if($request_data['otp'] == 888888)
            {
                // $user = new userModel();
                // $userdata =  $this->user->getUserData();
                
                $return['DATA'] = "";
                $return['ERROR_CODE'] = '0';
                $return['ERROR_DESCRIPTION'] = '';
            }else{
                $return['DATA'] = '';
                $return['ERROR_CODE'] = '2';
                $return['ERROR_DESCRIPTION'] = 'Invalid OTP.';
            }
           
        // }else{
        //     $return['DATA'] = '';
        //     $return['ERROR_CODE'] = '2';
        //     $return['ERROR_DESCRIPTION'] = 'Something is wrong.';
        // }
        return $return; 

    }

    public function checklogin(Request $request) {

        $return = array();

        $request_data = $request->all();

        $login = false;    

        if ($request->session()->has('thew_session')) {
            $session_data = $request->session()->get('thew_session');
            if($session_data['login_token'] == $request_data['token_id'])
            {
                $login = true; 
            }
        }
        
        if($login)
        {
            
            $return['DATA'] = '';
            $return['ERROR_CODE'] = '0';
            $return['ERROR_DESCRIPTION'] = '';
        }else{
            $return['DATA'] = '';
            $return['ERROR_CODE'] = '2';
            $return['ERROR_DESCRIPTION'] = '';
        }
        
        return json_encode($return);

    }
    
    public function checknotlogin(Request $request) {
        $return = array();

        $request_data = $request->all();

        if (!$request->session()->has('thew_session')) {

            $getlogintoken =  $this->user->getLoginToken($request_data);

            if(count($getlogintoken) == 1)
            {
                $sesionData = array(
                    "login_token" => $getlogintoken[0]->api_token,
                    "user_id" => $getlogintoken[0]->id,
                );

                // session()->put('thew_session', $sesionData);
                $request->session()->put('thew_session', $sesionData);

                $return['DATA'] = '';
                $return['ERROR_CODE'] = '2';
                $return['ERROR_DESCRIPTION'] = '';

            }else{
                $return['DATA'] = '';
                $return['ERROR_CODE'] = '0';
                $return['ERROR_DESCRIPTION'] = '';
            }
            
        }else{
            $return['DATA'] = '';
            $return['ERROR_CODE'] = '2';
            $return['ERROR_DESCRIPTION'] = '';
        }

        return json_encode($return);
    }

    public function getdata(Request $request) {

    	$arrayData = array();
    	$arrayData[] = array("id"=>1,"name"=>"sagar");
    	$arrayData[] = array("id"=>2,"name"=>"bele");
    	// $request_data = $request->all();
        return json_encode($arrayData); 
    }

    public function getOrderData(Request $request) {

        $return = array();

        $errors_message = "";
        $request_data = $request->all();

        $validator = Validator::make($request->all(), [
            'pick_up_date' => 'required',
            'slot' => 'required', 
            'name' => 'required', 
            'mobile' => 'required', 
            'address' => 'required', 
            'landmark' => 'required', 
            'pincode' => 'required', 
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $key => $value) {
                $errors_message .= $value."\n";
            }

            $return['DATA'] = '';
            $return['ERROR_CODE'] = '2';
            $return['ERROR_DESCRIPTION'] = $errors_message;
        }else{
            

            $responce = $this->orderModel->storeOrderData($request_data); 

            if($responce > 0)
            {
                $data = array(
                    "responce_id" => $responce
                );

                $return['DATA'] = $data;
                $return['ERROR_CODE'] = '0';
                $return['ERROR_DESCRIPTION'] = '';
            }else{
                $return['DATA'] = '';
                $return['ERROR_CODE'] = '2';
                $return['ERROR_DESCRIPTION'] = "Something is wrong with your data, please try again.";
            }
        }

        return json_encode($return);

    }

    public function getOrderlist(Request $request) {

        $return = array();

        $errors_message = "";
        $request_data = $request->all();

        $userid = 2;
        $request_data["user_id"] = $userid; 

        $responce = $this->orderModel->getOrderListData($request_data);

        $return['DATA'] = $responce;
        $return['ERROR_CODE'] = '0';
        $return['ERROR_DESCRIPTION'] = '';

        return json_encode($return); 
        
    }
    
    public function getOrderDetails(Request $request) {
        $return = array();

        $errors_message = "";
        $request_data = $request->all();

        $responce = $this->orderModel->getOrderDetails($request_data);

        $return['DATA'] = $responce;
        $return['ERROR_CODE'] = '0';
        $return['ERROR_DESCRIPTION'] = '';

        return json_encode($return);
    }

    public function getLastOrderData(Request $request) {
        $return = array();

        $errors_message = "";
        $request_data = $request->all();

        $session_data = $request->session()->get('thew_session');

        $userid = $session_data['user_id'];
        $request_data["user_id"] = $userid; 

        $responce = $this->orderModel->getLastOrderData($request_data);

        $return['DATA'] = $responce;
        $return['ERROR_CODE'] = '0';
        $return['ERROR_DESCRIPTION'] = '';

        return json_encode($return);
    }

    public function getServicesData(Request $request) {
        $return = array();

        $errors_message = "";
        $request_data = $request->all();

        $session_data = $request->session()->get('thew_session');

        $responce = $this->servicesModel->getServices($request_data);

        $return['DATA'] = $responce;
        $return['ERROR_CODE'] = '0';
        $return['ERROR_DESCRIPTION'] = '';

        return json_encode($return);
    }

}
