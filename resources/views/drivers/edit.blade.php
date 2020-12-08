@include('layouts.styles')
@include('layouts.header')



<div class="col-sm category mt-3" align="center">
      <h3>Обновить данные водителя</h3>
    </div>
     @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

  <div class="row" style="margin-top: 5px;">
 
    <div class="col-lg-5 mx-auto">

<form method="POST" action="{{ route('drivers.update', $edit_driver) }}" enctype="multipart/form-data">
	         @csrf
     @method('PATCH') 
   
  <div class="form-group">
    <label for="driver-name">Имя</label>
    <input type="text" name="name" class="form-control" id="driver-name" value="{{ $edit_driver->name }}">
  </div>
  <div class="form-group">
    <label for="driver-surname">Фамилия</label>
    <input type="text" name="lastname" class="form-control" id="driver-surname" value="{{ $edit_driver->last_name }}">
  </div>
  <div class="form-group">
    <label for="drvier-date">Дата рождения</label>
    <input type="date" name="date" class="form-control" id="driver-surname" value="{{ $edit_driver->birth_data }}">
  </div>
  <div class="form-group">
    <label for="driver-skill">Водительский стаж</label>
    <input type="text" name="skill" class="form-control" id="driver-skill" value="{{ $edit_driver->skill }}">
  </div>
  <div class="form-group">
    <label for="drvier-phone">Номер телефона</label>
    <input type="phone" name="phone" class="form-control" id="driver-phone" value="{{ $edit_driver->phone }}">
  </div>
    <div class="form-group">
     @if($edit_driver->GetVehicle() === NULL || $edit_driver->GetVehicle()->driver_id === NULL)
      <label for="driver-vehicle">ID управляемого ТС (свободное) | текущее авто: <strong>Не определено</strong></label>
    @else
       <label for="driver-vehicle">ID управляемого ТС (свободное) | текущее авто: <strong>{{ $edit_driver->GetVehicle()->brand }} </strong></label>
    @endif

    <select class="form-control" name="vehicle_id" id="driver-vehicle">
       @if($edit_driver->GetVehicle() != NULL)
         <option>{{ $edit_driver->GetVehicle()->brand }}</option>
      @else
         <option>Не определено</option>
      @endif
       @foreach($vehicles as $vehicle)
          @if($vehicle->driver_id == NULL)
            <option>{{ $vehicle->id }} </option>
          @endif
       @endforeach

    </select>
  </div>
  <div class="form-group">
    <label for="driver-photo">Фото водителя</label> 
    <input type="file" name="image" class="form-control-file" id="driver_photo" value=" {{ $edit_driver->getDriverImage()->path }}">
  </div>
  <button type="submit" class="btn btn-success">Обновить</button>
</form>
</div>
</div>
