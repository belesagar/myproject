<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class FranchisePanalController extends Controller
{
   	public function home(Request $request) {
		return view('admin.home');
    }

    public function dashboard(Request $request) {
        return view('admin.dashboard');
    }

    public function profile(Request $request) {

        $franchise_user_id = session('franchise_users')['franchise_user_id'];

        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;

        //This api for getting State
        $state_data = \Helpers::getDataFromApi("franchise_api/get_State_Data");
        // dd($request_data);
        //This api for storing activation data 
        $responce = \Helpers::getDataFromApi("franchise_api/get_user_data",$request_data);
        
        $result_data = array();

         if($responce['ERROR_CODE'] > 0)
         {
             Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
         }else{
            $result_data = $responce["DATA"][0];
         }
		return view('admin.profile',["state_data" => $state_data,"result_data" => $result_data]);
    }

    public function change_password(Request $request) {
		return view('admin.change_password');
    }

	public function activation(Request $request) {

        //This code is for getting type
        if(session()->has('type'))
        {
            $type = Session::get('type');
        }else{
            $type = "personal_details";
        }


        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];
        //This api for getting State
        $state_data = \Helpers::getDataFromApi("franchise_api/get_State_Data");
        // dd($state_data);
        

        //This api for getting Bank names
        $bank_data = \Helpers::getDataFromApi("franchise_api/get_Bank_Data");

        //This api for getting documents data
        $required_document_catrgory_array['category_array'] = json_encode(array('2','9'));
        $documents_data = \Helpers::getDataFromApi("franchise_api/get_Documents_Data",$required_document_catrgory_array);
        
        
         $franchise_user_data = array(
                "franchise_user_id" => $franchise_user_id,
                "franchise_id" => $franchise_id
         );

         $form_progress = 0;

         //This code for getting frenchise data
         $responce = \Helpers::getDataFromApi("franchise_api/get_franchise_data",$franchise_user_data);
         // dd($responce); 
         $franchise_data = array();

         if($responce['ERROR_CODE'] == 0)
         {
            if(count($responce["DATA"]) != 0)
            {
                $franchise_data = $responce["DATA"][0];

                //This code for cheking all tabs of activation flow is fill up or not
                $franchise_user_data["type"] = "on_call";
                $franchise_user_data["agree"] = "agree";

                $check_activation_data = \Helpers::getDataFromApi("franchise_api/submit_activation_form",$franchise_user_data);
                // dd($check_activation_data);
                if(count($check_activation_data['DATA']['status_data']) != 1)
                {
                    $activation_form_data = $check_activation_data['DATA']['status_data'];
                    $per_tab_value = (99 / count($activation_form_data));
                    foreach($activation_form_data as $activation_type)
                    {
                        if($activation_type == 1)
                        {
                            $form_progress = $form_progress + $per_tab_value;
                        }
                     
                    }
                }

            }
        }

         // dd($franchise_data); 

		return view('admin.activation',["bank_data" => $bank_data,"state_data" => $state_data,"documents_data" => $documents_data,"result_data" => $franchise_data,"type" => $type,"form_progress" => $form_progress]); 
    }

    public function getFranchiseActivationData(Request $request) {
        
        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = $request->all();
        
        if($request_data['type'] == "upload_documents")
        {
            $request_data['document_upload_source'] = 'FRANCHISE_WEB';
            foreach($request_data as $key => $file_data)  
            {
                if ($request->hasFile($key)) {
                     //print_r("<pre>"); 
                     $request_data[$key] = new \CurlFile($file_data->getPathName(),$file_data->getClientOriginalExtension(),$file_data->getClientOriginalName());
                    //print_r();//, $file_data->type, $file_data->name  new CurlFile($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["type"], $_FILES["upfile"]["name"]),
                }
                
            }
        }
        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;

       
        //This api for storing activation data 
        $responce = \Helpers::getDataFromApi("franchise_api/store_franchise_activation_data",$request_data);
        // dd($responce);
         if($responce['ERROR_CODE'] == 0)
         {
            $type_array = array("personal_details","franchise_details","business_details","account_details","upload_documents","location","submit_form");

            $type_key = array_search($request_data['type'], $type_array);
            
            Session::flash('success_message', $responce['DATA']);
            return redirect("activation")->with('type' , $type_array[++$type_key]);
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect("activation")->withInput($request->input())->with('type' , $request_data['type']);
         }


    }

    public function submitActivationForm(Request $request) {

        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;

        //dd($request_data);
        //This api for storing activation data 
        $responce = \Helpers::getDataFromApi("franchise_api/submit_activation_form",$request_data);
        // dd($responce); 
         if($responce['ERROR_CODE'] == 0)
         {
            $request->session()->put('franchise_users.is_registration_completed', '1');

            Session::flash('success_message', "Your data is successfully stored. Please wait for approval.");
            return redirect("activation")->with('type' , $request_data['type']);
         }else{

            Session::flash('error_message', "Some data is required to fill, Please check.");//$responce['ERROR_DESCRIPTION']
            return redirect("activation")->withInput($request->input())->with('type' , $request_data['type']);
         }


    }

    public function setChangePassword(Request $request) {
        $franchise_user_id = session('franchise_users')['franchise_user_id'];

        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;

        $responce = \Helpers::getDataFromApi("franchise_api/set_change_password",$request_data);
        //dd($responce);

        if($responce['ERROR_CODE'] == 0)
         {
            
            Session::flash('success_message', $responce['DATA']); 
            return redirect("change_password");
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect("change_password");
         }
    }

    public function updateProfileDetails(Request $request) {
        $franchise_user_id = session('franchise_users')['franchise_user_id'];

        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;

        $responce = \Helpers::getDataFromApi("franchise_api/update_profile_details",$request_data);
        //dd($responce);

        if($responce['ERROR_CODE'] == 0)
         {
            
            Session::flash('success_message', $responce['DATA']); 
            return redirect("profile");
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect("profile");
         }
    }

    public function getUserListData(Request $request) {

        // print_r("hiiiii");
        // exit;

        /*$franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];


        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;
        // dd($request_data); 
        $responce = \Helpers::getDataFromApi("franchise_api/get_franchise_users",$request_data);
        // dd($responce);

       /* if($responce['ERROR_CODE'] == 0)
         {*/
            
            return view('admin.user_list'); 
            // return view('admin.user_list',["user_data" => $responce['DATA']]); 
         /*}else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect()->route("dashboard");
         }*/
    }

    public function getUserData(Request $request,$id="") {

        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = $request->all();

        // $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;
        $request_data['franchise_user_id'] = $id;

        $data = array();

        if($id != "")
        {
            $responce = \Helpers::getDataFromApi("franchise_api/get_user_data",$request_data);
            // dd($responce);
            if($responce['ERROR_CODE'] == 0)
             {
                if($responce['DATA'][0]['franchise_id'] == $franchise_id)
                {
                    $data = $responce['DATA'][0];
                }else{
                    Session::flash('error_message', 'Invalid ID');
                    return redirect()->route("users");
                }
                
             }else{
                Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
                return redirect()->route("users");
             }
        }

        
        //This api for getting State
        $state_data = \Helpers::getDataFromApi("franchise_api/get_State_Data");

        //This array for role data
        $role_data = array(
            "" => "Select aby role",
            "USER" => "USER",
            "MANAGER" => "MANAGER",
            "ADMIN" => "ADMIN",
        );

        // $responce = \Helpers::getDataFromApi("franchise_api/get_franchise_user_data",$request_data);
        // dd($responce);

        
        return view('admin.create_edit_user',['result_data' => $data,"state_data" => $state_data,"role_data" => $role_data]);  
    }

    public function saveUserData(Request $request) {

        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;

        // dd($request_data); 
        //This api for getting State
        $responce = \Helpers::getDataFromApi("franchise_api/save_franchise_user_data",$request_data);
        // dd($responce); 
        if($responce['ERROR_CODE'] == 0)
         {
            
            Session::flash('success_message', $responce['DATA']);
            return redirect()->route("users"); 
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect()->route("user_operation")->withInput($request->input());
         }
    }

    public function getMerchantListData(Request $request) {

        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;
        // dd($request_data); 
        $responce = \Helpers::getDataFromApi("franchise_api/get_franchise_merchant_list_data",$request_data);
        // dd($responce); 

        if($responce['ERROR_CODE'] == 0)
         {
           return view('admin.merchant_list',["merchant_data" => $responce['DATA']]); 
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect()->route("dashboard")->withInput($request->input()); 
         }

    }

    public function getFranchiseMerchantData(Request $request,$id="") { 
        //This code is for getting type
        if(session()->has('type'))
        {
            $type = Session::get('type');
        }else{
            $type = "store_details";
        }

        // dd($type);

        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = $request->all();

        // $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;
        $request_data['merchant_id'] = $id;

       
        $data = array();
        
        if($id != "")
        {
            $responce = \Helpers::getDataFromApi("merchantapi/get_registration_status",$request_data);
            // dd($responce);
            if($responce['ERROR_CODE'] == 0) 
             {
                session(['merchant_id' => $id]);
                session(['site_id' => $responce['merchant_data']['site_id']]);
                //This api for getting Bank names
                $bank_data = \Helpers::getDataFromApi("franchise_api/get_Bank_Data");

                //This code for getting category data
                $category_data = \Helpers::getDataFromApi("merchantapi/list_merchant_onbording_category",$request_data);
                
                //This api for getting documents data
                $required_document_catrgory_array['category_array'] = json_encode(array('2','9'));
                $documents_data = \Helpers::getDataFromApi("franchise_api/get_Documents_Data",$required_document_catrgory_array);
                
                //This code for showing progress bar
                
                $form_progress = '10%';
                $page_progress = 0;
                if (isset($responce['store_status']) && isset($responce['kyc_status']) && isset($responce['upload_status'])) {
                    $page_progress = ($responce['store_status'] + $responce['kyc_status'] + $responce['upload_status']);
                }

                if ($page_progress == 1) { /* isset($data['merchant']['store_status']) && $data['merchant']['store_status'] == 1 */
                    $form_progress = '45%';
                }
                if ($page_progress == 2) {
                    $form_progress = '75%';
                }
                if ($page_progress == 3) {
                    $form_progress = '95%';
                }
        
                
               return view('admin.merchant_activation',['result_data' => $responce['merchant_data'],"merchant_doc" => $responce['merchant_doc'],"type" => $type,"form_progress" => $form_progress,"bank_data" => $bank_data,"documents_data" => $documents_data,"category_data" => $category_data]);  
                
             }else{
                Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
                return redirect()->route("merchant_list"); 
             }
        }

        
        
    }

    public function getMerchantActivationData(Request $request) {

        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $merchant_id = session('merchant_id');
        $site_id = session('site_id');

        $request_data = $request->all();

        // $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;
        $request_data['merchant_id'] = $merchant_id;
        $request_data['site_id'] = $site_id;

        // dd($request_data);  

        if($request_data['type'] == "store_details")
        {
            $api_name = "updatebusinessinfo";
        }else if($request_data['type'] == "kyc_details"){
            $api_name = "user_kyc";
        }else if($request_data['type'] == "upload_documents"){
            $api_name = "upload_document";
        }else if($request_data['type'] == "location"){
            $api_name = "set_site_location"; 
        }elseif($request_data['type'] == "categories"){
            $api_name = "save_merchant_category"; 
        }else{
            $api_name = "merchant_submit"; 
        }

        if($request_data['type'] == "categories"){
            $temparray = array();
            $temparray['categorycheck'] = isset($request_data['categorycheck'])?$request_data['categorycheck']:"";
            $request_data['data'] = json_encode($temparray);
            $request_data['categorycheck'] = "";
        }
        
        
        
        if($request_data['type'] == "upload_documents"){

            //This code upload cocuments
            $category_type = array(
                "add_proof_img" => array(
                                    "document_category" => 2,
                                    "document_type" => 0,
                                ),
                "pan_no_img" => array(
                                    "document_category" => 9,
                                    "document_type" => 38,
                                ),
                "vat_no_img" => array(
                                    "document_category" => 31,
                                    "document_type" => 76,
                                ),
                "ifsc_code_img" => array(
                                    "document_category" => 11,
                                    "document_type" => 40,
                                ),
                "last_bank_statement_img" => array(
                                    "document_category" => 29,
                                    "document_type" => 74,
                                ),
                "shop_establishment_license_img" => array(
                                    "document_category" => 32,
                                    "document_type" => 77,
                                ),
            );
           

            
            // dd($request_data);
            $upload_error_code = 0;
            $upload_error_msg = '';

            foreach($request_data as $key => $value)
            {
                if (array_key_exists($key,$category_type))
                {
                    $documet_data_array = array();   
                    if ($request->hasFile($key)) {

                        if($key == "add_proof_img")
                        {
                            $category_type[$key]["document_type"] = $request_data['add_document_type'];
                        }

                        $documet_data_array['document_category'] = $category_type[$key]["document_category"];
                        $documet_data_array['document_type'] = $category_type[$key]["document_type"];
                        
                        $documet_data_array["file"] = $value;



                        $documet_data_array['merchant_id'] = $merchant_id;
                        $documet_data_array['document_upload_source'] = "FRANCHISE_WEB";
                       
                        // dd($documet_data_array);

                        $responce = \Helpers::getDataFromApi("merchantapi/".$api_name,$documet_data_array);

                        // dd($responce);

                        if ($responce['ERROR_CODE']) {
                            $upload_error_code = 1;
                            $upload_error_msg = $upload_error_msg . '<br/> Error : ' . $responce['ERROR_DESCRIPTION'];
                        }

                        //print_r("<pre>");
                       
                    }

                } 
            }
           
        }

        //This api call when type is not uploads documents
        if($request_data['type'] != "upload_documents"){
            $responce = \Helpers::getDataFromApi("merchantapi/".$api_name,$request_data);
        }

         

        //This code for upload documents
        if($request_data['type'] == "upload_documents")
        {
            if (!$upload_error_code) {

                $type_array = array("store_details","kyc_details","upload_documents","location","categories","submit_form");

                $type_key = array_search($request_data['type'], $type_array);

                Session::flash('success_message', 'Data Uploaded successfully.');
                return redirect()->route("merchant_data", ['id' => $merchant_id])->with('type' , $type_array[++$type_key]);
            } else {
                Session::flash('error_message', $upload_error_msg);
                return redirect()->route("merchant_data", ['id' => $merchant_id])->with('type' , $request_data['type']);
            }
        } 


       if($responce['ERROR_CODE'] == 0) 
         {

            $type_array = array("store_details","kyc_details","upload_documents","location","categories","submit_form");

            $type_key = array_search($request_data['type'], $type_array);
            
            if($request_data['type'] == "submit_form")
            {
                $type_key = -1;
            }

            Session::flash('success_message', 'Data Uploaded successfully.');
            return redirect()->route("merchant_data", ['id' => $merchant_id])->with('type' , $type_array[++$type_key]);
            
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect()->route("merchant_data", ['id' => $merchant_id])->with('type' , $request_data['type']);
         }
    }

    
   public function PlApplication(Request $request) {
        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = array();

        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;
        $request_data['data'] = $franchise_id;
        
        //This code for encoding data 
        $responce_data = \Helpers::getDataFromApi("franchise_api/data_encode",$request_data);

         if($responce_data['ERROR_CODE'] != 0) 
         {
            Session::flash('error_message', $responce_data['ERROR_DESCRIPTION']);
            return redirect()->route("dashboard");  
         }

        $encode_franchise_id = $responce_data['DATA'];
       
       
        return view('admin.pl_application',["encode_franchise_id" => $encode_franchise_id]);
   }

   public function emi_card(Request $request) { 

        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = array();

        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;
        $request_data['data'] = $franchise_id; 

        //This code for encoding data 
        $responce_data = \Helpers::getDataFromApi("franchise_api/data_encode",$request_data);

        if($responce_data['ERROR_CODE'] != 0) 
         {
            Session::flash('error_message', $responce_data['ERROR_DESCRIPTION']);
            return redirect()->route("dashboard");  
         }

        $encode_franchise_id = $responce_data['DATA'];

        return view('admin.emi_card',["encode_franchise_id" => $encode_franchise_id]);
   }

   public function createMerchant(Request $request) { 
        return view('admin.create_merchant');
   }

   public function send_otp_for_merchant(Request $request) {
 

        // dd(json_encode($request->all()));

        $request_data = $request->all();

        // $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['to'] = "send";
        
        $response = array();

        $responce = \Helpers::getDataFromApi("franchise_api/sendotpforfranchise",$request_data);

        return $responce;

    }

    public function saveMerchantData(Request $request) {
        
        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;

        // dd($request_data); 
        //This api for getting State
        $responce = \Helpers::getDataFromApi("franchise_api/saveMerchantData",$request_data);
        // dd($responce); 
        if($responce['ERROR_CODE'] == 0)
         {
            
            Session::flash('success_message', "Merchant is created successfully.");
            return redirect()->route("merchant_list");
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect()->route("create_merchant")->withInput($request->input());
         }
    }
    
    public function flipkartOrder(Request $request) {
        return view('admin.flipkart_order');
    }
    
    public function saveFlipkartOrderData(Request $request) {

        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;

        

        //dd($request_data);
         $responce = \Helpers::getDataFromApi("franchise_api/saveFranchiseFlipkartData",http_build_query($request_data));
       
        if($responce['ERROR_CODE'] == 0)
         {
            
            Session::flash('success_message', $responce['DATA']);
            return redirect()->route("flipkart_order_list");
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect()->route("flipkart_order")->withInput($request->input()); 
         }

        
    }

     public function getFlipkartOrderListData(Request $request) {

        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];

        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;
        // dd($request_data); 
        $responce = \Helpers::getDataFromApi("franchise_api/get_flipkart_order_list_data",$request_data);
        // dd($responce); 

        if($responce['ERROR_CODE'] == 0)
         {
           
            $payment_mode = array(
                    "1" => "Cash on delivery", 
                    "2" => "Credit Card/Debit Card",
                    "3" => "Net Banking",
                    "4" => "Paid to Franchise",
                    "5" => "Others",
            );

           return view('admin.flipkart_order_list',["data" => $responce['DATA'],"payment_mode" => $payment_mode]); 
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect()->route("dashboard")->withInput($request->input()); 
         }

        // if($responce['ERROR_CODE'] == 0)
        //  {
            
             
         // }
    }

    public function getEmiCardListData(Request $request) {

        $franchise_user_id = session('franchise_users')['franchise_user_id'];
        $franchise_id = session('franchise_users')['franchise_id'];


        $request_data = $request->all();

        $request_data['franchise_user_id'] = $franchise_user_id;
        $request_data['franchise_id'] = $franchise_id;
        // dd($request_data); 
        $responce = \Helpers::getDataFromApi("franchise_api/get_emi_card_user_list_data",$request_data);
       // dd($responce); 
        if($responce['ERROR_CODE'] == 0)
         {
           
            return view('admin.emi_card_user_list',["emi_card_data" => $responce['DATA']]);   
         }else{
            Session::flash('error_message', $responce['ERROR_DESCRIPTION']);
            return redirect()->route("dashboard")->withInput($request->input()); 
         }

    }

}
