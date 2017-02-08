<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model
{
    protected $table = 'album_image';

    public $fillable = ['album_id', 'name'];

    public $timestamps = true;
}
