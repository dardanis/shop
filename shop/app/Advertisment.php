<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model {

	public function advertisment_types(){
		return $this->belongsTo('App\AdvertismentTypes','type');
	}

	public function advertisment_position(){
		return $this->belongsTo('App\AdvertismentPosition','position');
	}

	public function user(){
		return $this->belongsTo('App\User','user_id');
	}

}
