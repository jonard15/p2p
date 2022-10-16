<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\LibBrgies;

class GeoLocationController extends Controller
{
    public function stateCities(){
        $data =LibBrgies::select('brgy_id', 'region', 'province', 'psgc_mcode', 'muncity', 'geolocation')->groupBy('psgc_mcode','brgy_id','region','province','muncity','geolocation')->get();
        return $data;
    }

    public function villagesArea(){
        // 010000000: REGION I
        // 020000000: REGION II
        // 140000000: REGION CAR
        $data =LibBrgies::select('*')->whereIn('psgc_rcode', array('010000000', '020000000', '140000000'))->get();
        return $data;
    }
}
