<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>
@include('frontend.common.header')

@include('frontend.common.sidebar')
@yield('content')

@include('frontend.common.footer')

@stack('modals-script')
@yield('script')  
@yield('footer_script')


