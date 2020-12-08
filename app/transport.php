<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\drivers;
use App\images;
use App\status;
use App\transportcategory;

class transport extends Model
{
    protected $table = 'transport';


     protected $fillable = [
        'driver_id', 'brand', 'start_use', 'category', 'current_state', 'status', 'img_id',
    ];

       function getDriver()
       {   
            return drivers::where('transport_id', $this->driver_id)->first();
       }

  

       function getImage()
       {
           return images::where('id_vehicle', $this->img_id)->first();   
       }
         

       function getStatus()
       {   
       	return status::where('id', $this->status)->first();
       }

       function getCategory()
       {   
            $need_category = "транспорт данной категории отсутсвует";

       	    if(!empty(transportcategory::where('idd', $this->category)->first()))
            {
                $need_category = transportcategory::where('idd', $this->category)->first();
            }

            return $need_category;
       }

       public  $timestamps = false;

}
