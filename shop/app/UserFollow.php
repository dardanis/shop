<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model {

    protected $table = 'user_follows';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
