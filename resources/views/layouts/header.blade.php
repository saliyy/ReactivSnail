<header class="header">

  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="/" class="navbar-brand d-flex align-items-center">
       <img src="https://img2.freepng.ru/20180408/bpq/kisspng-snail-gastropods-slug-tail-animal-snail-5acad933adf502.9851187415232433157125.jpg"  
        style="width: 50px;"> 
        <h4 class="label"  style="color:white; margin-right:2cm">Реактивная улитка</h4>
      </a>

      <h5 style="margin-top: 13px;"><a href="{{ route('categories') }}" style="white-space: nowrap; 
      color: white;
      position:relative;">Категории авто</a></h5>


      <h5 id="hrefs" style="margin-top: 13px;"><a href="{{ route('drivers.index') }}" style="white-space: nowrap; 
      color: white;
      position:relative;
      margin-left: 20px;
      padding-left: 15px">Водители</a></h5>

       <h5 id="hrefs" style="margin-top: 13px;"><a href="/contacts" style="white-space: nowrap; 
      color: white;
      position:relative;
      margin-left: 20px;
      padding-left: 15px">Контакты</a></h5>

     @if(Auth::check())
        <h4 class="usercss"
         style="color:white;
          margin-top:14px; 
          margin-left:5px;
           padding-left:180px;"><strong>Привет {{Auth::user()->name}}!</strong></h4>

        <a href="{{ url('/logout')}}" class="hrefka">
          <strong style="color:white; 
          text-decoration:none; display: 
          inline-block; border-radius: 3px; 
           background: #32CD32; 
           margin-left:-500px;
            padding: 0.5rem 1.3rem; right:10%">Выход</strong>
      </a>
      @else 
      <a href="{{ route('login') }}" class="hrefka">
          <strong style="color:white; text-decoration:none;
           display: inline-block; border-radius: 3px;  
           background: #32CD32; position:relative; right:300px; padding: 0.5rem 1.3rem;">Войти</strong>
      </a>
      <a href="{{ route('register') }}" class="zho">
          <strong style="color:white; 
          text-decoration:none; display: 
          inline-block; border-radius: 3px; position:relative; 
          background: #0000FF; right: 290px;
            padding: 0.5rem 1.3rem;">Регистрация</strong>
      </a>
      @endif
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>