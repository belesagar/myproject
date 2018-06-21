<?php

namespace App\Model;
use DB;
use Session;

use Illuminate\Database\Eloquent\Model;

class servicesModel extends Model
{
    protected $services = 'services';

    public function getServices($postData)
    {
        $response = DB::table($this->services)->select('service_id','city_id','type','sub_type','service_price','service_type','service_image','is_active')->get();

        return $response;
    }

}
