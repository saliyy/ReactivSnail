<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class driver_images extends Model
{
    protected $table = 'driver_images';

	 protected $fillable = [
	    'driver_id', 'path'
	];

	protected $primaryKey = 'driver_id';

	  public  $timestamps = false;
}
