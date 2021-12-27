<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Changarru</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
      
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" src="{{asset('public/backend/assets/images/favicon.png')}}">

      <link href="{{ url('public/backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
      <link rel="stylesheet" href="{{ url('public/backend/assets/css/jquery.dataTables.min.css') }}">
      <link href="{{ url('public/backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
      <link href="https://unpkg.com/dropzone/dist/dropzone.css" rel="stylesheet"/>
      <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
      
      <link href="{{ url('public/backend/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ url('public/backend/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ url('public/backend/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<!--       <link href="{{ url('public/backend/assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
 -->
      <link href="{{ url('public/backend/assets/css/app-dark.min.css') }}" href="" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
      <link href="{{ url('public/backend/assets/css/icons.min.css') }}" href="" rel="stylesheet" type="text/css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">

      <link href="{{ url('public/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"  rel="stylesheet" type="text/css" />

      <link href="{{ url('public/backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"  rel="stylesheet" type="text/css" />

      <link href="{{ url('public/backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ url('public/backend/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet') }}" href="" type="text/css" />

      <link rel="stylesheet" href="{{ url('public/backend/assets/libs/quill/quill.bubble.css') }}">
      <link rel="stylesheet" href="{{ url('public/backend/assets/libs/quill/quill.core.css') }}">
      <link rel="stylesheet" href="{{ url('public/backend/assets/libs/quill/quill.snow.css') }}">
      <link rel="stylesheet" href="{{ url('public/backend/assets/css/chosen.css') }}">
      <link rel="stylesheet" href="{{ url('public/backend/assets/css/sweetalert.css') }}">

      <link rel="stylesheet" href="{{ url('public/backend/assets/css/toastr.css') }}">
      <link rel="stylesheet" href="{{ url('public/backend/assets/css/style.css') }}">

   </head>
   
   <body class="">
      <div id="wrapper">
      
         