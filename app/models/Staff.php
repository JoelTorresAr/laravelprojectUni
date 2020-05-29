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
    'name'      ,
    'lastname'  ,
    'phone'          ,
    'email',
    'birthday'
  ];
}
