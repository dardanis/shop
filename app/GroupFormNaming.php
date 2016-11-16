<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupFormNaming extends Model {

    public function category(){
        return $this->hasMany('App\Category');
    }


}
