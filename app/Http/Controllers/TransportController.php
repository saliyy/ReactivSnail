<?php

namespace App\Http\Controllers;

use Livewire\Component;

use App\images;
use App\Transport;
use App\transportcategory;
use App\drivers;
use App\status;
use App\transport as AppTransport;
use Carbon\Exceptions\BadComparisonUnitException;
use Illuminate\Http\Request;
use Livewire\WithPagination;



class TransportController extends Controller
{
  
 
    public function index()
    { 

       $vehicles = AppTransport::paginate(3);
       $drivers = drivers::all();
    
       return view('index', compact('vehicles', 'drivers'));
    }

    public function categories()
    {
        return view('categories');
    }

    public function category($category)
    {
        $categoryid = transportcategory::where('category', $category)->first()->idd;
        $categoried_vehicle = AppTransport::where('category', $categoryid)->get();
        return view('/category', compact('categoried_vehicle'));
    }

  public function getVehicleById($category, $car)
  {
      $car = AppTransport::where('id', $car)->first();
      return view('/car', compact('car'));
  }
  
}
