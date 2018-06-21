<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class dashboardModel extends Model
{
    protected $admin_user = 'admin_user';

    public function getAdminUserData($postData)
    {	
        $response = DB::table($this->admin_user)->select('admin_user_id','password','first_name','last_name','email','is_active','mobile','alternet_mobile_no','address_line1','address_line2','pincode','created_at')->where([
        	['admin_user_id',$postData['admin_user_id']],
        ])->get();
        
        return $response;
    }

    
}
