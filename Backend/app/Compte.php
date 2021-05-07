<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    //            'code_compte'=>'required',
   // 'libellee' =>'required'


   protected $fillable = [
    'code_compte', 'libellee',
];

}
