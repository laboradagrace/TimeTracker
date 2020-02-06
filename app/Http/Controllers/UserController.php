<?php

namespace App\Http\Controllers;

use App\user_info;
use App\UserTime_info;
use App\break_info;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserController extends Controller{

	public function retriveUsers()
    {
        $names = user_info::get();
        return view('welcome' , compact('names'));

    }
    public function storeTime_info(Request $request){
    	$data = UserTime_info::create([
    		'user_id' => $request->get('user_id'),
        	'clockIn' => $request->get('clockIn'),
        	'clockOut'=> $request->get('clockOut'),
    	]);
    	return response()->json($data);
    }
    public function updateClockOut(Request $request){
    	$time =UserTime_info::findOrFail($request->get('id'));

    	$time->clockOut = $request->get('clockOut');

    	$time->save();
    	return response()->json($time);
    }
    public function storeBreak_info(Request $request){
        $data = break_info::create([
            'time_id' => $request->get('time_id'),
            'start' => $request->get('start'),
            'end'=> $request->get('end'),
        ]);
        return response()->json($data);
    }
}
?>