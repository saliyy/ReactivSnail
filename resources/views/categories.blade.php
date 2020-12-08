@include('layouts.styles')
@include('layouts.header')


<div class="container" align="center" style="margin-top: 150px;">
  <div class="row">
    <div class="col-sm category">
      <h3>Легковые авто</h3>
      <a href="{{ route('category', 'Легковая') }}"><img src="/images/car.png" style="width: 250px"></a>
    </div>
    <div class="col-sm category">
      <h3>Грузовики</h3>
      <a href="{{ route('category', 'Грузовик') }}"><img src="/images/truck.png" style="width: 250px"></a>
    </div>
    <div class="col-sm category">
      <h3>Фургоны</h3>
       <a href="{{ route('category', 'Фургон') }}"><img src="/images/fura.png" style="width: 250px"></a>
    </div>
    <div class="col-sm category">
      <h3>Спецтехника</h3>
       <a href="{{ route('category', 'Спецтехника') }}"><img src="/images/spec.png" style="width: 250px"></a>
    </div>
  </div>
</div>

@include('layouts.footer')