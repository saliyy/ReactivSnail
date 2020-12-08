@include('layouts.styles')
@include('layouts.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

<strong style="text-shadow:
      1px 1px white,
      2px 2px #777;
    color: orange;
    font-size:35px;
    transition: all 1s; padding-left:625px;  margin-bottom:15px; ">Наш автопарк</strong>
</div>

<div class="container"> 
  @if(session()->get('success'))
    <div class="alert alert-success mt-3">
        {{ session()->get('success') }}
    </div>
      @endif

              @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif


<div id="app">
  @include('layouts.nav')
</div>

<div align="center">
  {{ $vehicles->links() }}
</div>
</div>

@include('layouts.footer')

<script src="{{ asset('js/app.js') }}"></script>
</html>
