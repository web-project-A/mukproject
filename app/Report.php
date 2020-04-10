<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [

        'User_Ip','Device_Browser_Detail',

    ];
}
