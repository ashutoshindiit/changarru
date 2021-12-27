
@include('frontend.common.header')

@include('frontend.common.sidebar1')
@yield('content')

@include('frontend.common.footer')

@stack('modals-script')
@yield('script')  
@yield('footer_script')

