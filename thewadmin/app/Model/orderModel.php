<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class orderModel extends Model
{
    protected $orders = "orders";

    public function getOrdersListData($postData)
    {	

        $response = DB::table($this->orders)->where([
            ['status',$postData['status']],
        ])->get();
        
        return $response;
    }

}
