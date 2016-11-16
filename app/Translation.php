<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model {

    public static $rules=array(

        'label'=>'unique:translations'

    );

}
