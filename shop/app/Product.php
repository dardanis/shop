<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Vinkla\Translator\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract {
	use Translatable;
	use SearchableTrait;

	protected $fillable = ['category_id','title','slug','description','search_keywords','teaser','price','availability','status','image','thumbnail','address'];
    protected $hidden = ['created_at', 'updated_at'];

    protected $translator = 'App\ProductTranslation';

	protected $translatedAttributes = ['title','slug','description','teaser','search_keywords'];

	protected $appends = ['title','slug','description','teaser','search_keywords'];

	protected $searchable = [
        'columns' => [
            'user_id' => 10,
            'product_translations.slug'=>2,
            'product_translations.title'=>2,
			'product_translations.teaser'=>2,
            'product_translations.description'=>2,
			'product_translations.search_keywords'=>2,
            'category_translations.slug'=>2,
            'category_translations.name'=>2,
            'subcategory_translations.name'=>2,
            'subcategory_translations.slug'=>2,
            'users.name'=>2,
            'users.username'=>2
        ],
        'joins' => [
            'product_translations' => ['products.id','product_translations.product_id'],
            'category_translations'=>['products.category_id','category_translations.category_id'],
            'subcategory_translations'=>['products.subcategory_id','subcategory_translations.subcategory_id'],
            'users'=>['products.user_id','users.id']
        ],
    ];


	public function getTitleAttribute()
	{
		return $this->title;
	}
	public function getTeaserAttribute()
	{
		return $this->teaser;
	}
	public function getSlugAttribute()
	{
		return $this->slug;
	}
	public function getDescriptionAttribute()
{
	return $this->description;
}
	public function getSearchKeywordsAttribute()
	{
		return $this->search_keywords;
	}
	public static $rules=array(

		'title'=>'required|min:3',
		'teaser'=>'required|min:10',
		'description'=>'required|min:20',

		'search_keywords'=>'',
		'price'=>'numeric',
		'availability'=>'integer',
		'image'=>'required|image|mimes:jpeg,jpg,bmp,png',
		'category_id'=>'required',
		'type_id'=>'required',


	);

	public function translations(){
		return $this->hasMany('App\ProductTranslation');
	}
	public function category(){
		return $this->belongsTo('App\Category');
	}
	public function subcategory(){
		return $this->belongsTo('App\Subcategory');
	}
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function pictures(){
		return $this->hasMany('App\Picture');
	}

	public function atributes(){
		return $this->hasMany('App\Attributes');
	}

	public function reviews()
  	{
	return $this->hasMany('App\Review');
  	}
  	public function recalculateRating()
  	{
	    $reviews = $this->reviews()->notSpam()->approved();
	    $avgRating = $reviews->avg('rating');
	    $this->rating_cache = round($avgRating,1);
	    $this->rating_count = $reviews->count();
	    $this->save();
  	}

}