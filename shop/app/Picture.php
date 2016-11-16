<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model {

    protected $table = 'images';

    protected $fillable = ['image'];
    public function products(){
        return $this->belongsTo('App\Product','id');
    }

}