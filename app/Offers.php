<?php namespace App;


use Illuminate\Database\Eloquent\Model;

use Vinkla\Translator\Translatable;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;
class Offers extends Model implements TranslatableContract  {
    use Translatable;
    protected $fillable = ['title','description'];


    protected $hidden = ['created_at', 'updated_at'];

    protected $translator = 'App\OffersTranslations';

    protected $translatedAttributes = ['title', 'description'];

    public function getTitleAttribute()
    {
        return $this->title;
    }

    public function getDescriptionAttribute()
    {
        return $this->description;
    }

    protected $appends = ['title', 'description'];

    public function translations(){
        return $this->hasMany('App\OffersTranslations');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }



}
