<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EventFields extends Model {

	protected $table='event_fields';

    protected $fillable = ['id','event_id','date_event','time_from','time_to','updated_at','created_at'];
}
