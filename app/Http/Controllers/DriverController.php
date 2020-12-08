<?php

namespace App\Http\Controllers;

use App\drivers;
use App\driver_images;
use Illuminate\Http\Request;
use App\transport as AppTransport;
use DB;
use Storage;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $vehicles = AppTransport::all();
        $drivers = drivers::paginate(3);
        return view('drivers.index', compact('drivers', 'vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = AppTransport::all();
        return view('drivers.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rand = mt_rand(0, 10000);

        $request->validate([
            'name'=>'required',
            'lastname'=>'required',
            'date'=>'required',
            'skill'=>'required',
            'phone'=>'required',
            'vehicle_id' => 'required',
            'image' => 'required|file|image'
    
        ]);

       
        DB::table('drivers')->insert([
              'name' => $request->get('name'),
              'last_name' => $request->get('lastname'),
              'birth_data' => $request->get('date'),
              'skill' => $request->get('skill'),
              'phone' => $request->get('phone'),
              'transport_id' => $rand,
              "img_id" => $rand
            ]);

       $vehicle = AppTransport::where('id', $request->get('vehicle_id'))->first();
       $vehicle->driver_id = $rand;
       $vehicle->save();


     
        DB::table('driver_images')->insert([
            ['driver_id' => $rand, 'path' => $_FILES['image']['name'] ]
        ]);

        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name, "images/" . $name);

        return redirect('drivers')->with('success', 'Данные водителя успешно загружены на сервер!');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function show($driver)
    {
        $current_driver = drivers::find($driver);

        return view('drivers.show', compact('current_driver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function edit($driverid)
    {
        $vehicles = AppTransport::all();
        $edit_driver = drivers::find($driverid);
        return view('drivers.edit', compact('edit_driver', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $driverid)
    {
        $rand = mt_rand(0, 10000);

         $request->validate([
            'name'=>'required',
            'lastname'=>'required',
            'date'=>'required',
            'skill'=>'required',
            'phone'=>'required',
            'vehicle_id' => 'required',
        ]);

           
            $update_driver = drivers::find($driverid);

           
            $update_driver->name = $request->get('name');
            $update_driver->last_name = $request->get('lastname');
            $update_driver->birth_data = $request->get('date');
            $update_driver->skill = $request->get('skill'); // стаж 
            $update_driver->phone = $request->get('phone');

            if($request->get('vehicle_id') === "Не определено"){

            }
            else
            {
                if($update_driver->GetVehicle() != NULL){

                    if($request->get('vehicle_id') === $update_driver->GetVehicle()->brand){

                    }
                    else
                    {
                        $last_tranport = AppTransport::where('driver_id', $update_driver->transport_id)->first();
                        $last_tranport->driver_id = NULL;
                        $last_tranport->save();
                    // то мы переводим транспорт в состояние без закрпленного водителя
                        $update_driver->transport_id = $rand;
                        $vehicle = AppTransport::where('id', $request->get('vehicle_id'))->first();
                        $vehicle->driver_id = $rand;
                        $vehicle->save();

                    // и закрепляем за ним нового водителя 
                       
                     }
                }
                else
                {
                        $update_driver->transport_id = $rand;
                        $vehicle = AppTransport::where('id', $request->get('vehicle_id'))->first();
                        $vehicle->driver_id = $rand;
                        $vehicle->save();
                }
                   
            }
         
                       // если фотография не была выбрана то не меняем ее
            if(is_null($request->file('image'))){ }
            else
            {
                 $current_image = driver_images::where('driver_id', $update_driver->img_id)->first();
                 $update_driver->img_id = $rand;

                 if(file_exists("images/" . $current_image->path))
                 {
                     unlink("images/" . $current_image->path);
                 }

                 $name = $_FILES['image']['name'];
                 $current_image->driver_id = $rand;
                 $current_image->path = $name;
                 $current_image->save();

                 $tmp_name = $_FILES['image']['tmp_name'];
                 move_uploaded_file($tmp_name, "images/" . $name);
                 
            }

 
              $update_driver->save();

              return redirect('drivers')->with('success', 'Данные водителя успешно обновлены!');

          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function destroy($driver)
    {

        // обрабатываем все связи
        $current_driver = drivers::find($driver);

        $fixed_image = driver_images::where('driver_id', $current_driver->img_id)->first();
        $fixed_image->delete();

        $fixed_vehicle = AppTransport::where('driver_id', $current_driver->transport_id)->first();
        $fixed_vehicle->driver_id = null;
        $fixed_vehicle->save();

        $current_driver->delete();

        return redirect('drivers')->with('success', 'Водитель уволен, соответсвующее письмо было отправлено ему на почту');
    }
}
