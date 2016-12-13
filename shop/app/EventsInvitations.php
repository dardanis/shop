<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsInvitations extends Model {
   
	protected $table='event_envitations';
	protected $fillable = ['id','event_id','user_id','created_at','updated_at'];
}
