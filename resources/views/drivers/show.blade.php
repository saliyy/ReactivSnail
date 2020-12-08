<link krel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
@include('layouts.styles')
@include('layouts.header')


   @if(Auth::check() && Auth::user()->isAdmin())
<div class="container mt-3" style="margin-left: 35%">
<div class="row">

<div class="col-md-4">
              <div class="card mb-3 box-shadow">
                <img class="card-img-top" src="/images/{{ $current_driver->getDriverImage()->path }}" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_175991cf486%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_175991cf486%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <div class="card-body">
             <ul class="list-group list-group">
                <li class="list-group-item"><strong >Имя:</strong> {{$current_driver->name }}</li>
                <li class="list-group-item"><strong>Фамилия:  </strong>  {{$current_driver->last_name }}</li>
                <li class="list-group-item"> <strong>Дата рождения: </strong>  {{ $current_driver->birth_data }}</li>
                 <li class="list-group-item"> <strong>Водительский стаж:  </strong>  {{ $current_driver->skill }}</li>
                   @if(Auth::check() && Auth::user()->isAdmin())
                      <li class="list-group-item"> <strong>управляемое ТС:  </strong>
                      @if($current_driver->GetVehicle() === NULL || $current_driver->GetVehicle()->driver_id === NULL) 
                            не определено
                      @else
                             <a href="{{ route('car', [ $current_driver->GetVehicle()->getCategory()->category, $current_driver->getVehicle()->id]) }}">
                            {{ $current_driver->GetVehicle()->brand }}</li></a>
                      @endif
                     
                    @endif
                     <li class="list-group-item"><strong>Телефон:  </strong>  {{$current_driver->phone }}</li>
                          <div class="d-flex justify-content-between align-items-center" style="margin-top: 5px">
                              <div class="btn-group">
                        <a  href="{{ route('drivers.edit', $current_driver) }}" class="btn btn-sm btn-outline-warning content-hidden">Редактировать</a>
                        <form method="POST" action="{{route( 'drivers.destroy', $current_driver)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger content-hidden" style="top: 5px">Уволить</button>
                      </form>
            </ul>

              </div>
            </div>

</div>
    </div>
@else
  Как вы здесь оказались ? У вас нет прав администратора чтобы пользоваться данной функцией
@endif


@include('layouts.footer')
