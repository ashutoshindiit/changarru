@include('backend.common.header')
<style type="text/css">
    .error{
        color: red;
    }
    .inbox
    {
        padding: 0;
    }

    .inbox span{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        padding: 15px;
    }
</style>

<div class="account-pages loginpage">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo logo logo-light text-center">
    
                                    <span class="logo-lg">
                                        <img src="{{asset('public/backend/assets/images/logo.png')}}" alt="" height="22">
                                    </span>
                            </div>
                            <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
                        </div>
                        <form action="{{url('/admin/login')}}" method="post" id="admin-login">
                            @csrf
                            @if(Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            <div class="form-group mb-3">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" name="email" required="" type="email" value="" id="emailaddress"  placeholder="Enter your email">
                            </div>
                           <div class="form-group mb-3">
                               <label for="password">Password</label>
                               <div class="input-group input-group-merge ">
                                    <input type="password" name="password" value="" required="" id="password" class="form-control" placeholder="Enter your password">
                                    <div class="input-group-append inbox" data-password="false">
                                        <div class="input-group-text divPasswordShow inbox">
                                           <span class="fas fa-eye" id="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                <label for="password" class="error"></label>
                            </div>

                           <!--  <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked="" id="checkbox-signin" name="remember_me" value="1">
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div> -->

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> Log In </button> 
                                <!-- <a class="btn btn-primary btn-block" href="index.php"> Log In </a> -->
                            </div>
                        </form>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
                <div class="row foot">
                    <div class="col-12 text-center">
                        <p> <a href="{{url('admin/forgot-password')}}" class="ml-1">Forgot your password?</a>
                        </p>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<script type="text/javascript" src="{{url('public/backend/assets/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/backend/assets/js/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{url('public/backend/assets/js/toastr.min.js')}}"></script>

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
    $(document).ready(function(){
        $('#admin-login').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password:{
                    required:true,
                    maxlength:50,
                    // minlength:6
                },
            },
            messages: {
                email: {
                    required: "Please enter your email",
                    email : "Please enter a valid email"
                },
                password:{
                    required:"Please enter password",
                },
            },
       
        });


        // $('#password-eye').click(function(){
        //     $(this).toggleClass("fa-eye fa-eye-slash");
        //     var input = $('#password');
        //   if (input.attr("type") == "password") {
        //     input.attr("type", "text");
        //   } else {
        //     input.attr("type", "password");
        //   }
    });

    $(document).on('click','#password-eye',function(){
        $(this).toggleClass("fa-eye fa-eye-slash");
          var input = $('#password');
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
    });

    // $(document).on('click','.divPasswordShow',function(){
    //     $(this).children().toggleClass("fa-eye fa-eye-slash");
    //       var input = $('#password');
    //     if (input.attr("type") == "password") {
    //       input.attr("type", "text");
    //     } else {
    //       input.attr("type", "password");
    //     }
    // });
</script>