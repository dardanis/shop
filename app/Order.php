<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {


    protected $fillable = ['id','order_id','user_id','total_paid','created_at'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }
}
