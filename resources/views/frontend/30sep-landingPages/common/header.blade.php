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
    
</head>
<body>

<header>
  <nav class="navbar navbar-expand-lg navbar-light"> 
    <div class="container">
      <a class="navbar-brand" href="{{url('home/index')}}"><img src="{{asset('public/frontend/landingPage/assets/images/logo.png')}}" alt="Logo" /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="navbar-toggler-icon"></span> </button> 

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="navbar-nav">
              <li class="nav-item"> <a class="nav-link" href="{{url('/home/index')}}">Home <span class="sr-only">(current)</span></a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{url('/home/about-us')}}">About us</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{url('/home/blog')}}">Blog</a> </li>
              <li class="nav-item"> <a class="nav-link" href="{{url('/home/faq')}}">Faq</a> </li>
            </ul>
            <a class="btn btn-info custombtn ml-md-auto" href="{{url('/home/contact-us')}}"><i class="fas fa-phone-alt"></i> Contact Us</a>
        </div>
      </div>
  </nav>
</header>
