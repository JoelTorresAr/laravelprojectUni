<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    public function index()
    {
        return DB::table('districts')
        ->orderBy('name')
        ->get();
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showbycity($id)
    {
        return DB::table('districts')
        ->join('cities','districts.city_id','=','cities.id')
        ->select('districts.*')
        ->where('cities.id',$id)
        ->orderBy('name')
        ->get();
    }
}
