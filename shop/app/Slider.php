<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {

	public function category(){
		return $this->belongsToMany('App\Category','categories_slider','slider_id','category_id');
	}

}
