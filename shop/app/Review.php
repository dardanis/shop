<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use Auth;
class Review extends Model {

   public static $rules=array(
    'comment'=>'required',
    'rating' =>'required'
  );
	public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function product()
  {
    return $this->belongsTo('App\Product');
  }

  public function scopeApproved($query)
  {
    return $query->where('approved', true);
  }

  public function scopeSpam($query)
  {
    return $query->where('spam', true);
  }

  public function scopeNotSpam($query)
  {
    return $query->where('spam', false);
  }
  public function storeReviewForProduct($pID, $comment, $rating)
  {
    $product = Product::find($pID);
    $this->user_id = Auth::user()->id;
    $this->comment = $comment;
    $this->rating = $rating;
    $product->reviews()->save($this);

    // recalculate ratings for the specified post
    $product->recalculateRating();
  }

}
