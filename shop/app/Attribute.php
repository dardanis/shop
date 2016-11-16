<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    public static $rules=array(

    );

    public function products(){
        return $this->hasMany('App\Product');
    }

}
