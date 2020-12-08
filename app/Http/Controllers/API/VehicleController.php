<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\transport;
use App\drivers;
use App\images;
use App\status;
use App\transportcategory;
use DB;


class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
 
           $this->validate($request, [
            'brand' => 'required',
            'start_use' => 'required',
            'category' => 'required',
            'current_state' => 'required',
            'image' => 'required'
          ]);



        $need_category = transportcategory::where('category', $request->get('category'))->first();


         DB::table('transport')->insert([
              'brand' => $request->get('brand'),
              'start_use' => $request->get('start_use'),
              'category' => $need_category->idd,
              'current_state' => $request->get('current_state'),
              'status' => 1,
              'driver_id'=> NULL,
              "img_id" => $rand
            ]);

         DB::table('images')->insert([
            ['id_vehicle' => $rand, 'path' => $_FILES['image']['name'] ]
        ]);


        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name, "images/" . $name);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\drivers  $drivers
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle_id)
    {
        $edit_vehicle = transport::where('id', $vehicle_id)->first();
        return view('edit_vehicle', compact('edit_vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $rand = mt_rand(0, 10000);


            $this->validate($request, [
            'brand' => 'required',
            'start_use' => 'required',
            'status' => 'required',
            'current_state' => 'required',
          ]);


        $update_vehicle = transport::find($id);
        $update_vehicle->brand = $request->get('brand');
        $update_vehicle->start_use = $request->get('start_use');
        $update_vehicle->current_state = $request->get('current_state');

        $update_status = status::where('name_status', $request->get('status'))->first();
        $update_vehicle->status = $update_status->id;
       
       
         if(is_null($request->file('image')))
            { }
            else
            {
                 $update_image = images::where('id_vehicle', $update_vehicle->img_id)->first();

                 $update_vehicle->img_id = $rand;

                 if(file_exists("images/" . $update_image->path))
                 {
                     unlink("images/" . $update_image->path);
                 }

                 $name = $_FILES['image']['name'];
                 $update_image->id_vehicle = $rand;
                 $update_image->path = $name;
                 $update_image->save();

                 $tmp_name = $_FILES['image']['tmp_name'];
                 move_uploaded_file($tmp_name, "images/" . $name);
                 
            }

            $update_vehicle->save(); 

            return redirect('/')->with('success', 'Данные ' . $update_vehicle->brand . ' Успешно обновлены');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_transport = transport::where('id', $id)->first();

        $need_driver = drivers::where('transport_id', $delete_transport->driver_id)->first();
        $need_driver->transport_id = null;
        $need_driver->save();

        $need_image = images::where('id_vehicle', $delete_transport->img_id)->first();

         if(file_exists("images/" . $need_image->path))
         {
             unlink("images/" . $need_image->path);
         }

         $need_image->delete();

        $delete_transport->delete();

    }
}
