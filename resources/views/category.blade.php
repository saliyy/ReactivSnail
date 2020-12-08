@include('layouts.styles')
@include('layouts.header')
<div id="app">
<meta name="csrf-token" content="{{ csrf_token() }}">


@if(count($categoried_vehicle) === 0)
  <h3 align="center">К сожалению Транспорт данной категории отстутвует</h3>
@else
@if(($categoried_vehicle[0]->getCategory()->category) == "Легковая")
      <h3 style="color:orange" align="center">Легковые авто</h3>
@elseif (($categoried_vehicle[0]->getCategory()->category) == "Грузовик")
	   <h3 style="color:orange" align="center">Грузовики</h3>
@elseif (($categoried_vehicle[0]->getCategory()->category) == "Фургон")
	   <h3 style="color:orange" align="center">Фургоны</h3>
@else 
		<h3 style="color:orange" align="center">Спецтехника</h3>
@endif 
@endif



<div class="container">
    <div class="row">
@foreach($categoried_vehicle as $vehcat)
<div class="col-md-4">
              <div class="card mb-3 box-shadow">
                <img class="card-img-top" src="images/{{ $vehcat->getImage()->path }}" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_175991cf486%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_175991cf486%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Марка: </strong> {{ $vehcat->brand }}</li>
                <li class="list-group-item"><strong>Год выпуска: </strong> {{$vehcat->start_use }}</li>
                <li class="list-group-item"><strong>Категория: </strong> {{ $vehcat->getCategory()->category }}</li>
            </ul>
                     @If(Auth::check() && Auth::user()->isAdmin())
                        <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                     <a href="{{ route('car', [$vehcat->getCategory()->category, $vehcat->id]) }}"><button type="button" id="btn_admin"  class="btn btn-sm btn-outline-primary content-hidden">Подробнее</button></a>
                         <a href="{{ route('update_vehicle', [$vehcat->id]) }}"><button type="button" id="btn_admin" class="btn btn-sm btn-outline-warning content-hidden">Редактировать</button></a>
                        <vehicle-component id_vehicle="{{ $vehcat->id }}"></vehicle-component>
                      </div>
                    </div>
                    @else
                        <script src="{{URL::asset('js/hide.js')}}"></script>
                         <script src="{{URL::asset('js/hide_links.js')}}"></script>
                @endif
                </div>
              </div>
            </div>
@endforeach
</div>
    </div>
</div>
</div>


@include('layouts.footer')