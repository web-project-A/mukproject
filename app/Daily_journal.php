<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daily_journal extends Model
{
    protected $fillable = [

        'std_number', 'reg_number', 'course', 'fname', 'other_name', 'phoneCode', 'number', 'email', 
        'organisation', 'org_address', 'org_number', 'field_supervisor_fname', 
        'field_supervisor_other', 'academic_supervisor_fname', 'academic_supervisor_other',
        'User_Ip','Device_Browser_Detail',

    ];
}
