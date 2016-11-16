<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Activity;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function add_activity($userId,$text,$type){
		$activity=new Activity;
		$activity->user_id=$userId;
		$activity->text=$text;
		$activity->type=$type;
		$activity->save();
	}

}
