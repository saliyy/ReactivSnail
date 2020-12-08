<?php

namespace App;
use App\drivers;
use App\driver_images;

use Illuminate\Database\Eloquent\Model;

class drivers extends Model
{
    protected $table = 'drivers';

     protected $fillable = [
        'name', 'last_name', 'birth_data', 'skill', 'phone', 'transport_id', 'img_id',
    ];
  
    function getDriverImage()
   {   
   	   return driver_images::where('driver_id', $this->img_id)->first();
   }

    function GetVehicle()
   {   
            
        return transport::where('driver_id', $this->transport_id)->first();
   }


   function GetVehicleId($vehicle_id)
   {
        
        $need_vehicle = "ТС не определено";
           
         if(!empty(transport::where('id', $vehicle_id)->first()->id))
         {
              $need_vehicle = transport::where('id', $vehicle_id)->first()->id;
         }
         return $need_vehicle;
   }

    public  $timestamps = false;
}
