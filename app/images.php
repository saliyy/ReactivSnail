<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $table = 'images';


	 protected $fillable = [
	    'id_vehicle', 'path'
	];

	protected $primaryKey = 'id_vehicle';

	  public  $timestamps = false;
}
