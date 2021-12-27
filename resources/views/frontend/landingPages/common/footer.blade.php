  <footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                
                <img src="{{asset('public/frontend/landingPage/assets/images/logo-1.png')}}" class="img-fluid" alt="" />
                <p>{!!@$homepageInformation['footer_description']!!}</p>
            </div>
            <div class="col-lg-9 col-md-6">
                <!--<h3>Compañía</h3>-->
                <ul class="footer_page_link">
                    <li> <a href="{{url('/about-us')}}">Acerca de</a></li>
                    <?php foreach ($pages as $key => $page): ?>
                        <li> <a href="{{url('/page/'.$page->page_name)}}">{{$page['title']}}</a></li>
                    <?php endforeach ?>
                    <li> <a href="{{url('/contact-us')}}">Contacto</a></li>
                    <li> <a href="{{url('/faq')}}">Preguntas frecuentes</a></li>
                </ul>
            </div>
            <!-- <div class="col-lg-3 col-md-6">
                <h3>Región</h3>
                <ul>
                    {{-- <li> <a href="{{url('/store-directory')}}">Stores Directory</a></li> --}}
                    <li> <a href="#">Artículos prohibidos</a></li>
                    <li> <a href="#">Ayudar</a></li>
                    <li> <a href="{{url('/blog')}}">Blog</a></li>
                </ul>
            </div> 
            <div class="col-lg-3 col-md-6">
                <h3>Ayudar</h3>
                <ul>
                    <li> <a href="#">Centro de ayuda</a></li>
                    <li> <a href="#">Soporte de contacto</a></li>
                    <li> <a href="#">Instrucciones</a></li>
                    <li> <a href="#">Cómo funciona</a></li>
                </ul>
            </div> -->
        </div>    
    </div>
    <div class="copyright text-center">
        <p>©2021 <span>CHANGARRU</span>. All rights reserved</p>
    </div>
  </footer>

  <div class="scroll-top not-visible">
     <i class="fa fa-angle-up"></i>
  </div>

<script src="{{ url('frontend/assets/js/vendor/jquery-3.4.1.min.js') }}"></script>
<script src="{{ url('frontend/landingPage/assets/js/jquery.min.js') }}"></script>
<script src="{{ url('frontend/assets/js/jquery.validate.js') }}"></script>


<script src="{{ url('frontend/landingPage/assets/js/popper.min.js') }}"></script>
<script src="{{ url('frontend/landingPage/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('frontend/landingPage/assets/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ url('frontend/landingPage/assets/js/owl.carousel.js') }}"></script>
<script src="{{ url('frontend/landingPage/assets/js/main.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{asset('frontend/assets/js/toastr.min.js')}}"></script>

<script>
    $(window).on('load', function() { // makes sure the whole site is loaded 
      $('#loader').fadeOut(); // will first fade out the loading animation 
      $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
      $('body').delay(350).css({'overflow':'visible'});
    })
</script>
<script>
    @if(Session::has('success'))
        $(function () {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "10000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success("{{ Session::get('success') }}");
        });
    @endif    
    @if(Session::has('error'))
        $(function () {
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "10000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            toastr.error("{{ Session::get('error') }}");
        });
    @endif  
</script>




<script type="text/javascript">
    $(document).on('click', '.categoryBlogClass', function(){

        $('.categoryBlogClass').css("font-weight", "");
        $(this).css("color", "#000");
        var categoryId  = $(this).attr('category');

        var csrf_token  = $('meta[name=csrf-token]').attr('content');
        $.ajax({
            url: "{{ url('/blog-category-wise-detail') }}",
            data: {categoryId:categoryId,_token:csrf_token},
            type: 'POST',
            success: function (data) {
                console.log(data)
                var data = JSON.parse(data);
                $('.categoryBlog_wise_class').html(data.html);
             }         
        });
    });
</script>

<script type="text/javascript">
    
    $(document).on('keyup', '.blog-search', function(e){
        var search = $(this).val();
        // var catId = $('#blog-search-segment').val();
        var csrf_token  = $('meta[name=csrf-token]').attr('content');
        $.ajax({
            url: "{{ url('/blog-category-wise-detail') }}",
            data: {search:search,_token:csrf_token},
            type: 'POST',
            success: function (data) {
                var data = JSON.parse(data);
                $('.categoryBlog_wise_class').html(data.html);
             }         
        });
    });
</script>

</body>
</html>