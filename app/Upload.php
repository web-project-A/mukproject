<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
   protected $fillable = [

        'User_Ip','user_id','Device_Browser','Device_platform',
    ];

}
