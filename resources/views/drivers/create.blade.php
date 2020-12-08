@include('layouts.header')
@include('layouts.styles')


<div class="col-sm category mt-3" align="center">
      <h3>Добавить водителя</h3>
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

 @If(Auth::check() && Auth::user()->isAdmin())
  <div class="row" style="margin-top: 5px;">
 
    <div class="col-lg-5 mx-auto">

<form method="POST" action="{{ route('drivers.store') }}" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="driver-name">Имя</label>
    <input type="text" name="name" class="form-control" id="driver-name">
  </div>
  <div class="form-group">
    <label for="driver-surname">Фамилия</label>
    <input type="text" name="lastname" class="form-control" id="driver-surname">
  </div>
  <div class="form-group">
    <label for="drvier-date">Дата рождения</label>
    <input type="date" name="date" class="form-control" id="driver-surname">
  </div>
  <div class="form-group">
    <label for="driver-skill">Водительский стаж</label>
    <input type="text" name="skill" class="form-control" id="driver-skill">
  </div>
  <div class="form-group">
    <label for="drvier-phone">Номер телефона</label>
    <input type="phone" name="phone" class="form-control" id="driver-phone">
  </div>
    <div class="form-group">
    <label for="driver-vehicle">ID управляемого ТС (свободное)</label>
    <select class="form-control" name="vehicle_id" id="driver-vehicle">
       @foreach($vehicles as $vehicle)
          @if($vehicle->driver_id == NULL)
            <option>{{ $vehicle->id }} </option>
          @endif
       @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="driver-photo">Фото водителя</label>
    <input type="file" name="image" class="form-control-file" id="driver_photo">
  </div>
  <button type="submit" class="btn btn-success">Сохранить</button>
</form>
</div>
</div>
@else
  Как вы здесь оказались ? У вас нет прав администратора чтобы пользоваться данной функцией
@endif
@include('layouts.footer')
