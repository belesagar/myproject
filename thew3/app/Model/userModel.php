<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class userModel extends Model
{
    //
    protected $table = 'users';

    public function storeUserData($postData)
    {
    	// Session::set('temp_user_details', $postData); 
        session(['temp_user_details' => $postData]);
    }

    public function checkUser($postData)
    {
        $responce = DB::table('users')->select('id','mobile','api_token')->where('mobile',$postData['mobile'])->get();
        return $responce;
    }

    public function getLoginToken($postData)
    {
        $responce = DB::table('users')->select('id','mobile','api_token')->where('api_token',$postData['token_id'])->get();
        return $responce;
    }

    public function getUserData()
    {
        $userdata = session('temp_user_details');
        // $userdata = Session::get('temp_user_details');
        return $userdata;
    }

    public function updateUserData($id,$updateData)
    {
        $responce = DB::table('users')->where('id', $id)->update($updateData);
        return $responce;
    }

    public function insertUserData($postData)
    {

        $id = DB::table('users')->insertGetId(
            $postData
        );
        
        return $id;
    }

}
