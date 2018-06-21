<?php

class Helpers {

    //This code for showing error and success message
    public static function show_message() {

        $message = "";
        if (Session::has('success_message')) {
            $message = '
    			<div class="alert alert-success class_alert_message">
			        ' .
                    Session::get("success_message")
                    . '
			        
				</div>
    	';
        }

        if (Session::has('error_message')) {
            $message = '
    			<div class="alert alert-danger class_alert_message">
			        ' .
                    Session::get("error_message")
                    . '
			        
				</div>
    	';

        // Session()->forget('error_message');
        
        }

        

        return $message;
    }

    //This function for getting random code 
    public static function genRandomCode($size) {
        $length = $size;
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //length:36
        $final_rand = '';
        for ($i = 0; $i < $length; $i++) {
            $final_rand .= $chars[rand(0, strlen($chars) - 1)];
        }

        return $final_rand;
    }

    //This code for calling api call
    public static function getDataFromApi($functionname, $param = array(), $type = "POST",$header_array = array()) {

        $url = \Config::get('constant.API_LINK') . $functionname;
        
        error_reporting(E_ALL);

        // Same as error_reporting(E_ALL);
        ini_set("error_reporting", E_ALL);
        
        $curl = curl_init(); 
        // dd($url);
        if ($type == "POST") {
            $method = 1; //Post
        } else {
            $method = 0; //GET
        }

        if (isset($param['file'])) {
            $tmp_path = $param['file']->getRealPath();
            $type_data = $param['file']->getMimeType();

            $file = new CURLFile($tmp_path, $type_data, $param['file']->getClientOriginalName());

            $param['file'] = $file;
        }
        // dd(http_build_query($param));

        // $header_data = array(
        //     "username : guest",
        //     "password : guest",
        //     "token : HalfTicket",
        //     'Authorization: Basic YWRtaW46ZmFzdGJhbmtpbmcxMjM0'
        // );

        $header_data = array('Authorization: Basic YWRtaW46ZmFzdGJhbmtpbmcxMjM0'); 

        //This header information is for set the token for geting franchise data
        $client_id = "client_id=".\Config::get('constant.TOKEN');  

        if (session()->has('channel_partner_users')) {
             
             if(isset(session('channel_partner_users')['token']))
             {
                 $client_id .= ",token=".session('channel_partner_users')['token'];
             }           
             
        }
        // // dd($client_id);
         $header_data = array('Authorization:'.$client_id);  

        // dd($header_data);

         if(count($header_array) != 0)
         {
             $header_data = array_merge($header_data,$header_array);
         }
        
        curl_setopt($curl, CURLOPT_URL, $url); 

        if ($type == "POST") {

             //dd($param);
            curl_setopt($curl, CURLOPT_POST, $method);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $param); //http_build_query($param)

        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header_data);
        curl_setopt($curl, CURLOPT_USERAGENT, "Fastbanking");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        

        
        $data = curl_exec($curl);

        \Log::info("Request from API ->".$data);

        // dd($data);
        // print_r("<pre>");
        // print_r($data);
        // exit; 
        // echo curl_error($curl);
        // exit;
        // dd($data);
        $data = json_decode($data, true);
       
         // dd($data); 


         $responce_header = curl_getinfo($curl);
        // // $header = substr($data, 0, $header_size);
        // // $body = substr($data, $header_size);

        //This code for getting api data and managed error code responce
        $responce = array();

        $responce = $data;
        // // dd($responce); 
         // dd($responce_header);
         if($responce_header['http_code'] == 401) 
         {
             if($data['error_code'] == 215)
             {
                 return redirect('login');
             }
             $responce["DATA"] = "";
             $responce["ERROR_CODE"] = $data['error_code'];
             $responce["ERROR_DESCRIPTION"] = "Some information is missing please try again later.";//$data['info']
         }

        // dd($responce);

        //  print_r("<pre>"); 
        //  print_r($data);  
        // exit;                            

        curl_close($curl);

        return $responce;
    }

    public static function get_kissht_merchant_data($type) {
        if ($type == "kissht_base_url") {
            return \Config::get('constant.BASE_URL');
        } elseif ($type == "merchant_id") {
            return \Config::get('constant.MERCHANT_ID');
        } elseif ($type == "sitekey") {
            return \Config::get('constant.SITEKEY');
        } elseif ($type == "secret_key") {
            return \Config::get('constant.SECRET_KEY');
        } elseif ($type == "product_sitekey") {
            return \Config::get('constant.PRODUCT_SITEKEY');
        } elseif ($type == "product_secret_key") {
            return \Config::get('constant.PRODUCT_SECRET_KEY');
        } elseif ($type == "sitekey_lowcash") {
            return \Config::get('constant.SITEKEY_LOWCASH');
        } elseif ($type == "secret_key_lowcash") {
            return \Config::get('constant.SECRET_KEY_LOWCASH');
        } elseif ($type == "instant_cash_key_data") {
            return \Config::get('constant.INSTANT_CASH_KEYS');
        }  
    }

    public static function status_messages() {

         $statusmsgs = array(
            'CUST_ABORT' => 'Transaction Not Completed',
            'DENIED_1' => 'Online Rejection',
            'DENIED_2' => 'Underwriting Rejection',
            'COND_APPROVED' => 'Submitted & Waiting For Underwriting',
            'FINAL_APPROVED' => 'Approved & Sanctioned',
            'ORDER_RETURN_REQUESTED' => 'Return Requested',
            'ORDER_RETURNED' => 'Returned',
            'ORDER_CANCEL_REQUESTED' => 'Cancel Requested',
            'ORDER_CANCELED' => 'Cancelled',
            'DENIED_3' => 'Cancelled by Merchant');

         return $statusmsgs;
    }

    public static function fastloan_call($request) {
        error_reporting(0);
        $data = array();
        // dd($request);
        //Available on the Kissht Merchant Panel
        $merchant_id = $request["merchant_id"];
        $sitekey = $request["sitekey"];
        $secret_key = $request["secret_key"];
        $base_url = $request["base_url"];

        //Data Provided by Merchant
        $redirect_url = $request["redirect_url"];
        $cancel_url = $request["cancel_url"];

        $franchise_id = session('franchise_users')['franchise_id'];
        $order_id = "FRANCHISEE$franchise_id" . time();

        $InputArr = array(
            'order_id' => $order_id,
            'transaction_amount' => $request["amount"],
            'user_verified_email' => "",
            'user_verified_mobile' => "",
            'first_name' => "",
            'last_name' => "",
            'sitekey' => $sitekey,
            'merchant_id' => $merchant_id,
            'redirect_url' => $redirect_url,
            'cancel_url' => $cancel_url,
            'number_of_txns_6_months' => '',
            'ratio_card_payments' => '',
            'ratio_net_payments' => '',
            'ratio_cod_payments' => '',
            'number_of_returns' => '',
            'transaction_average_value' => '',
            'billing_address' => '',
            'billing_city' => '',
            'billing_state' => '',
            'billing_pincode' => '',
            'billing_country' => '',
            'billing_tel' => '',
            'billing_email' => '',
            'billing_name' => '',
            'customer_since' => '',
            'number_of_cancels' => '',
            'moratorium_period' => '',
            'is_moratorium_loan' => '',
            'shipping_address_1' => '',
            'shipping_address_2' => '',
            'shipping_city' => '',
            'shipping_pincode' => '',
            'shipping_state' => '',
            'shipping_country' => '',
            'franchise_id' => $franchise_id, 
            'sku_list' => isset($request["sku_list"])?$request["sku_list"]:'',
        );
        // dd($InputArr);
        //Create the payload to be encrypted
        foreach ($InputArr as $key => $value) {
            $merchant_data .= $key . '=' . urlencode($value) . '&';
        }
        
        //encrypt the payload
        $encrypted_data = encrypt($merchant_data, $secret_key); // Method for encrypting the data.
        // dd($encrypted_data);

        // dd($this->decrypt($encrypted_data, $secret_key));

        $data["data"] = $encrypted_data;
        $data["mer_id"] = $merchant_id;
        $data["sitekey"] = $sitekey;
        $data["base_url"] = $base_url;

        /*print_r($data["data"]);
        exit*/;

        return $data;
    }

    public static function encrypt($plainText, $key) {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
        $plainPad = $this->pkcs5_pad($plainText, $blockSize);
        if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) {
            $encryptedText = mcrypt_generic($openMode, $plainPad);
            mcrypt_generic_deinit($openMode);
        }
        return bin2hex($encryptedText);
    }

}

?>
