<!DOCTYPE html>
<html lang="en">
<head>
  <title>Changarru</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link href="{{ asset('frontend/landingPage/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/landingPage/assets/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/landingPage/assets/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/landingPage/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/landingPage/assets/css/reponsive.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css" integrity="sha512-uHuCigcmv3ByTqBQQEwngXWk7E/NaPYP+CFglpkXPnRQbSubJmEENgh+itRDYbWV0fUZmUz7fD/+JDdeQFD5+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/toastr.css')}}" type="text/css" media="all" />

</head>
<body>
    <meta name="csrf-token" content="{{ csrf_token() }}">
      
    <div id="preloader">
      <div id="loader"></div>
    </div>

<header>
  <nav class="navbar navbar-expand-lg navbar-light"> 
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><img src="{{@$homepageInformation['header_logo']?asset('frontend/landingPage/assets/images/header-logo/'.@$homepageInformation['header_logo']):asset('frontend/images/default.jpg')}}" alt="Logo" /></a>
      
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="navbar-toggler-icon"></span> </button> 

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="navbar-nav">
              <li class="nav-item"> <a class="nav-link" href="{{url('/')}}">Inicio <span class="sr-only">(current)</span></a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{url('/about-us')}}">Acerca de Nosotros</a> </li>
              <!--<li class="nav-item"> <a class="nav-link" href="{{url('/blog')}}">Blog</a> </li> -->
              <li class="nav-item"> <a class="nav-link" href="{{url('/faq')}}">Preguntas Frecuentes</a> </li>
            </ul>
            <a class="btn btn-info custombtn ml-md-auto" href="{{url('/contact-us')}}"><i class="fas fa-phone-alt"></i>Contacto</a>

            <a class="navbar-toggler crossicon" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
              <i class="far fa-times-circle"></i>
            </a> 
        </div>
      </div>
  </nav>
</header>
