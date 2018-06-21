<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class usersModel extends Model
{
    protected $users = "users";

    public function getUsersListData($postData)
    {	

        $response = DB::table($this->users)->where($postData['whereData'])->offset($postData['offset'])->limit($postData['length'])->get();
        
        return $response;
    }

    public function getUsersDataCount($postData)
    {	
        $response = DB::table($this->users)->where($postData['whereData'])->count();
        return $response;
    }

    public function getUserData($postData)
    {   
        $response = DB::table($this->users)->select('id','name','email','is_active','mobile','alternet_mobile_no','address_line1','address_line2','pincode','created_at')->where([
            ['id',$postData['id']],
        ])->get();
        
        return $response;
    }

    public function checkUserEmail($postData)
    {   
        $response = DB::table($this->users)->select('id','email')->where([
            ['email',$postData['email']],
        ])->get();
        
        return $response;
    }

}
