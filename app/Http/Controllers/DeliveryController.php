<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Để sử dụng Hash
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
session_start();
class DeliveryController extends Controller
{
    public function delivery()
    {
        $city = City::orderBy('matp', 'ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }

    public function select_delivery(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>---Chọn quận huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}

    		}else{

    			$select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>---Chọn xã phường---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}
    	
    }

    public function insert_delivery(Request $request){
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];

        $fee_ship->save();
    }
}
