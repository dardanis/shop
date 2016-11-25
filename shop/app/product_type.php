<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class product_type extends Model {

    /**
     * Table product_type
     */
    protected  $table = 'product_types';

    public static $rules=array(

        'name'=>'required|min:3',
        'alias'=>'required|min:3',

        'hex' => array(
            'type' => 'header_color',
            'title' => 'Color',
        )
    );


}
