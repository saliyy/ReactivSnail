@include('layouts.styles')
@include('layouts.header')



  @if(session()->get('success'))
    <div class="alert alert-success mt-3">
        {{ session()->get('success') }}
    </div>
      @endif

   <strong style="text-shadow:
      1px 1px white,
      2px 2px #777;
    color: orange;
    font-size:35px;
    transition: all 1s; padding-left:500px;  margin-bottom:15px;">Обновить данные {{ $edit_vehicle->brand }} </strong>
</div>

 <div class="row" style="margin-top: 10px;">
  <div class="col-lg-5 mx-auto">
      <form method="POST" action="{{ route('vehicles.update', $edit_vehicle->id) }}" enctype="multipart/form-data">
           @csrf
           @method('PATCH') 
           <div class="form-group">
            <label for="exampleFormControlInput1">Марка ТС</label>
            <input type="text" name="brand" class="form-control" value="{{ $edit_vehicle->brand }}" id="exampleFormControlInput1" placeholder="{{ $edit_vehicle->brand }}">
          </div>
            <div class="form-group">
            <label for="exampleFormControlInput1">Год выпуска ТС</label>
            <input type="number" name="start_use" min="1980" max="2020"  value="{{ $edit_vehicle->start_use }}" class="form-control" id="exampleFormControlInput1" placeholder="{{ $edit_vehicle->start_use }}">
          </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Статус ТС</label>
              <select class="form-control" name="status"  id="exampleFormControlSelect1">
                <option>Активна</option>
                <option>На ремонте</option>
                <option>Не используется</option>
                <option>Продана</option>
              </select>
            </div>
             <div class="form-group">
                <label for="exampleFormControlInput1">Текущее состояние ТС</label>
                <input type="text" name="current_state" value="{{ $edit_vehicle->current_state }}" class="form-control" id="exampleFormControlInput1" placeholder="{{ $edit_vehicle->current_state }}">
              </div>
           <div class="form-group">
              <label for="driver-photo">Фото ТС</label>
              <input type="file" name="image" class="form-control-file" id="driver_photo">
            </div>
          <button type="submit" class="btn btn-success">Обновить</button>
      </form>
</div>
</div>



<script src="{{ asset('js/app.js') }}"></script>

@include('layouts.footer')