<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SubsidiaryController extends Controller
{
    
    public function index()
    {
        return DB::table('subsidiaries')
        ->orderBy('name')
        ->get();
    }
}
