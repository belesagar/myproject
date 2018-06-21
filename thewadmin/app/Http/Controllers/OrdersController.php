<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\orderModel;
use Session;
use DB;

class OrdersController extends Controller
{
    public function __construct()
    {
         $this->orderModel = new orderModel();
         $this->sessionName = \Config::get('constant.SESSION_NAME');
    }

    public function index(Request $request) {

		return view('admin.orders.orders_list');
    }
    
    public function ordersTableData(Request $request) {

    	return view('admin.orders.orders_table');
    }

    public function getOrderData(Request $request) {

    	$request_data = $request->all();

    	$statusArray = array();

    	$postData = array(
    		"status" => $request_data['status']
    	);
    	$orderModel =  $this->orderModel->getOrdersListData($postData);

    	$dataarray = array();

    	$dataarray['recordsTotal'] = $orderModel->count();
        $dataarray['recordsFiltered'] = $orderModel->count();
        $dataarray['data'] = $orderModel;

        print_r(json_encode($dataarray)); 
    	exit;

    	//return view('admin.orders.orders_table');
    }
    
}
