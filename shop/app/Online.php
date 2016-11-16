<?php namespace App;

use Carbon\Carbon;
use App\User;
use Session;
use Config;
use Auth;
class Online extends \Eloquent {

    protected $hidden = ['payload'];

    protected $fillable = ['user_id'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'sessions';

    public $timestamps = false;

    /**
     * Returns the user that belongs to this entry.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Returns all the guest users.
     *
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGuests($query)
    {
        return $query->whereNull('user_id')->where('last_activity', '>=', strtotime(Carbon::now()->subMinutes(10)));
    }

    /**
     * Returns all the registered users.
     *
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegistered($query)
    {
        return $query->whereNotNull('user_id')->where('last_activity', '>=', strtotime(Carbon::now()->subMinutes(10)))->with('user');
    }

    /**
     * Updates the session of the current user.
     *
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpdateCurrent($query)
    {
       /* return $query->where('id', Session::getId())->update([
            'user_id' => ! empty(Auth::user()) ? Auth::user()->id : null
        ]);*/
    }

}