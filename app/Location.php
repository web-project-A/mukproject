<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [

        'ip_addr','user_id','country','countryCode','regionName','city','lat',
        'lon','timezone',
    ];
   
}
