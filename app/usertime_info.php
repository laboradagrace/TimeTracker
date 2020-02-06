<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usertime_info extends Model
{
    protected $fillable = [
    	'user_id',
        'clockIn',
        'clockOut',
       	
	];
}
