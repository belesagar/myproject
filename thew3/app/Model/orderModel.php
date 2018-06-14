<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class orderModel extends Model
{
    //
    protected $table = 'orders';

    public function storeOrderData($postData)
    {
        $user_id = session('thew_session')['user_id'];

        $orderCount = $this->getOrderCountData();

        $order_unique_id = 1000+$orderCount;

    	$insertArr = array(
            "order_unique_id" => $order_unique_id,
    		"user_id" => $user_id,
            "name" => $postData['name'],
            "mobile" => $postData['mobile'],
    		"order_date" => $postData['pick_up_date'],
    		"pick_up_slot" => $postData['slot'],
    		"status" => "Ordered",
    		"address_line1" => $postData['address'],
    		"landmark" => $postData['landmark'],
    		"pincode" => $postData['pincode'],
    		"created_at" => date("Y-m-d H:i:s"), 
    	);
    	$responce_id = DB::table($this->table)->insertGetId($insertArr);

    	return $responce_id;
    }

    public function getOrderListData($postData)
    {
        $responce = DB::table($this->table)->select('order_id','order_unique_id','user_id','service_ids','order_date','pick_up_slot','weight_of_order','amount_of_order','total_amount','status')->where('user_id',$postData['user_id'])->get();

        return $responce;
    }
    
    public function getOrderDetails($postData)
    {
        $responce = DB::table($this->table)->select('order_id','order_unique_id','user_id','service_ids','order_date','pick_up_slot','weight_of_order','amount_of_order','total_amount','status')->where('order_id',$postData['order_id'])->get();

        return $responce;
    }

    public function getLastOrderData($postData)
    {
        $responce = DB::table($this->table)->select('order_id','order_unique_id','user_id','name','mobile','address_line1','address_line2','landmark','pincode')->where('user_id',$postData['user_id'])->orderBy('order_id', 'desc')->first();

        return $responce;
    }

    public function getOrderCountData()
    {
        $responce = DB::table($this->table)->count();

        return $responce;
    }

}
