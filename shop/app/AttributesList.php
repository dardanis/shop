<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributesList extends Model {

    public function attributes(){
        return $this->belongsTo('App\Attribute');
    }


}
