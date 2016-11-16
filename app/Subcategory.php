<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Vinkla\Translator\Translatable;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;

class Subcategory extends Model implements TranslatableContract {
	use Translatable;
	protected $fillable = ['name','slug','category_id'];

	protected $hidden = ['created_at', 'updated_at'];
	
	protected $translator = 'App\SubcategoryTranslation';

	protected $translatedAttributes = ['name', 'slug'];

	protected $appends = ['name', 'slug'];

	public function getNameAttribute()
	{
		return $this->name;
	}
	public function getSlugAttribute()
	{
		return $this->slug;
	}

	public static $rules=array('name'=>'required|min:2');
	public function category(){
		return $this->belongsTo('App\Category');
	}
	public function products(){
		return $this->hasMany('App\Product');
	}

	public function translations(){
		return $this->hasMany('App\SubcategoryTranslation');
	}
}