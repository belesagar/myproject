<?php

$table_prefix = "tbl_fastbanking";

$environment = env('ENVIRONMENT'); 

$instant_cash_data = array();

//This code for setting database as per Environment 
if ($environment == 'local') {

    // $base_url = "http://192.168.1.111/fastbanking/"; 
    // $base_url = "http://192.168.1.99/kissht/"; 
    $base_url = "http://localhost/kissht/";   
    $ncash_url = "http://localhost/ncash/"; 
   
} elseif ($environment == 'dev') {

    // $base_url = "http://192.168.1.111/fastbanking/"; 
    $base_url = "http://192.168.1.99/kissht/";   
    // $base_url = "http://localhost/fastbanking-core/";  
    $ncash_url = "http://192.168.1.111/ncash/";
   
} elseif ($environment == 'stage') {
    $base_url = "https://www.stage.kissht.com/";
    $ncash_url = "http://192.168.1.111/ncash/";
   
} elseif ($environment == 'test') {
    $base_url = "https://www.test.fastbanking.com/";
    $ncash_url = "http://192.168.1.111/ncash/";
  
} elseif ($environment == 'prod') {
    //$base_url = "https://www.fastbanking.com/";   
    $base_url = "https://kissht.com/"; 
    $ncash_url = "https://quickrupiya.com/";
  
}  
 
/* AMAZON S3 CONSTANT */
if ($environment == 'prod') { 
    $bucket = 'fastbankingprodbucket';
} else {
    $bucket = 'fastbankingdemobucket';
}

return[
    //This constant of API
    "BASE_URL" => $base_url,
    "NCASH_URL" => $ncash_url,
    "API_LINK" => $base_url . "api/v1/",
    /* AMAZON S3 CONSTANT */
    "AMAZON_HOST" => 'https://s3-ap-southeast-1.amazonaws.com/',
    "BUCKET" => $bucket,
    "TOKEN" => "SOZjvzjI6tlUPYSkPfCGC0cHiqzFg0TDMXdzcxTj",  
    "SESSION_NAME" => "thewadmin",  
    "ADMIN_USER" => "admin_user",  
    "USERS" => "users"
];
