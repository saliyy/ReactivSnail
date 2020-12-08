@include('layouts.styles')
@include('layouts.header')


@section('title', 'Водители')

<div class="align-center">
<strong style="text-shadow:
      1px 1px white,
      2px 2px #777;
    color: orange;
    font-size:35px;
    transition: all 1s; padding-left:625px;  margin-bottom:15px; ">Наши водители</strong>
</div>

<div class="container" style="margin-top: 15px">
  @If(Auth::check() && Auth::user()->isAdmin())
         <a style="padding-right: 15px; margin-bottom: 5px" 
 class="btn btn-success" href="{{ route('drivers.create') }}">Добавить водителя</a>
    @if(session()->get('success'))
    <div class="alert alert-success mt-3">
        {{ session()->get('success') }}
    </div>
      @endif
  @else
  @endif

    <div class="row">


   

@foreach($drivers as $driver)
<div class="col-md-4">
              <div class="card mb-3 box-shadow">
                <img class="card-img-top" src="images/{{ $driver->getDriverImage()->path }}" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_175991cf486%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_175991cf486%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <div class="card-body">
             <ul class="list-group list-group">
                <li class="list-group-item"><strong >Имя:</strong> {{$driver->name }}</li>
                <li class="list-group-item"><strong>Фамилия:  </strong>  {{$driver->last_name }}</li>
                <li class="list-group-item"> <strong>Дата рождения: </strong>  {{ $driver->birth_data }}</li>
                 <li class="list-group-item"> <strong>Водительский стаж:  </strong>  {{ $driver->skill }}</li>
                     @if(Auth::check() && Auth::user()->isAdmin())
                     <li class="list-group-item"> <strong>управляемое ТС:  </strong>
                        @if($driver->GetVehicle() === NULL || $driver->GetVehicle()->driver_id === NULL) 
                            не определено
                      @else
                             <a href="{{ route('car', [ $driver->GetVehicle()->getCategory()->category, $driver->getVehicle()->id]) }}">
                            {{ $driver->GetVehicle()->brand }}</li></a>
                      @endif
                 
                      <li class="list-group-item"><strong>Телефон:  </strong>  {{$driver->phone }}</li>
                         @endif
                        <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      @If(Auth::check() && Auth::user()->isAdmin())
                        <a  href="{{ route('drivers.show', $driver) }}" class="btn btn-sm btn-outline-success content-hidden" >Подробнее</a>
                        <a  href="{{ route('drivers.edit', $driver) }}" class="btn btn-sm btn-outline-warning content-hidden">Редактировать</a>
                        <form method="POST" action="{{route( 'drivers.destroy', $driver)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger content-hidden">Уволить</button>
                      </form>
                      @else
                      @endif
                       
                    </div>
                  </div>
            </ul>
                </div>
              </div>
            </div>
@endforeach
{{ $drivers->links() }}
</div>
    </div>



@include('layouts.footer')


