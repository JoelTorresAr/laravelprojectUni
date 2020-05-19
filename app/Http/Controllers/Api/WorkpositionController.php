<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WorkpositionController extends Controller
{
    public function index()
    {
        return DB::table('workpositions')
        ->orderBy('name')
        ->get();
    }
    public function show($id)
    {
        return DB::table('workpositions')
        ->join('workstations','workpositions.workstation_id','=','workstations.id')
        ->select('workpositions.*')
        ->where('workstations.id',$id)
        ->orderBy('name')
        ->get();
    }
}
