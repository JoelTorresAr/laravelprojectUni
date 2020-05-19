<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WorkstationController extends Controller
{
    public function index()
    {
        return DB::table('workstations')
        ->orderBy('name')
        ->get();
    }
}
