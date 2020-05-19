<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
  protected $fillable = [
    'subsidiary_id',
    'workposition_id',
    'district_id'    ,
    'address'        ,
    'firstname'      ,
    'firstlastname'  ,
    'secondlastname' ,
    'phone'          ,
    'email'  
  ];
}
