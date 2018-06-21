<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class loginModel extends Model
{
    protected $admin_user = "admin_user";
    
    public function getLoginData($postData)
    {	
        $response = DB::table($this->admin_user)->select('admin_user_id','first_name','last_name','email','is_active','mobile')->where([
        	['email',$postData['email']],
        	['password',$postData['password']]
        ])->get();
        
        return $response;
    }

}
