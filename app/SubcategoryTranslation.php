<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SubcategoryTranslation extends Model {
    public function category(){
        return $this->belongsTo('App\SubCategory');
    }


}
