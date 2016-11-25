<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Vinkla\Translator\Translatable;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract {
	use Translatable;
	protected $fillable = ['name','slug','description'];
	public static $rules=array('name'=>'required|min:3');

	protected $hidden = ['created_at', 'updated_at'];

    protected $translator = 'App\CategoryTranslation';

	protected $translatedAttributes = ['name', 'slug','description'];

	protected $appends = ['name', 'slug','description'];

	public function getNameAttribute()
	{
		return $this->name;
	}
	public function getSlugAttribute()
	{
		return $this->slug;
	}
	public function getDescriptionAttribute()
	{
		return $this->description;
	}
	

	public function translations(){
		return $this->hasMany('App\CategoryTranslation');
	}

	public function subcategories(){
		return $this->hasMany('App\Subcategory');
	}

	public function products(){
		return $this->hasMany('App\Product');
	}
	public function attributes(){
		return $this->hasMany('App\Attributes');
	}
}