<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index()
    {
        return DB::table('cities')
        ->orderBy('name')
        ->get();
    }    
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showbydistrict($id)
    {
        return DB::table('cities')
        ->join('districts','cities.id','=','districts.city_id')
        ->select('cities.*')
        ->where('districts.id',$id)
        ->limit(1)
        ->get();
    }
}
