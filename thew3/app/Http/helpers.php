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
    public static function getDataFromApi($functionname, $param = array(), $type = "POST") {

        $url = \Config::get('constant.API_LINK') . $functionname;

        $curl = curl_init();

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


        $header_data = array(
            "username : guest",
            "password : guest",
            "token : HalfTicket",
            'Authorization: Basic YWRtaW46ZmFzdGJhbmtpbmcxMjM0'
        );


        
       
        curl_setopt($curl, CURLOPT_URL, $url); 

        if ($type == "POST") {

            //dd($param);
            curl_setopt($curl, CURLOPT_POST, $method);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $param); //http_build_query($param)

        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header_data);
        curl_setopt($curl, CURLOPT_USERAGENT, "Fastbanking");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        

        
        $data = curl_exec($curl);
        // echo curl_error($curl);
        // exit;
        // dd($data);
        $data = json_decode($data, true);

       
        //  print_r("<pre>"); 
        //  print_r($data);  
        // exit;                            

        curl_close($curl);

        return $data;
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
        }
    }

}

?>
