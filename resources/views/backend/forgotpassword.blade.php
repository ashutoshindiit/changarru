<!-- Header -->
@include('backend.common.header')
<div class="account-pages loginpage">
   <div class="container h-100">
      <div class="row h-100 justify-content-center align-items-center">
         <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-pattern">
               <div class="card-body p-4">
                  <div class="text-center w-75 m-auto">
                     <div class="auth-logo">
                        <a href="index.php" class="logo logo-light text-center">
                        <span class="logo-lg">
                        <img src="{{asset('public/backend/assets/images/logo.png')}}" alt="" height="22">
                        </span>
                        </a>
                     </div>
                     <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                  </div>
                 <form action="{{url('/admin/forgot-password')}}" id="admin-forget-password" method="post">
                    @csrf

                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    
                    <div class="form-group mb-3">
                        <label for="emailaddress">Email address</label>
                        <input class="form-control" type="email" name="email" value="" id="emailaddress"  placeholder="Enter your email">
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"> Reset Password </button>
                    </div>
                  </form>
               </div>
               <!-- end card-body -->
            </div>
            <!-- end card -->
            <div class="row foot">
               <div class="col-12 text-center">
                  <p>Back to <a href="{{url('admin/login')}}"><b>Log in</b></a></p>
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
   $('#admin-forget-password').validate({
        ignore:[],
        rules:{
            "email":{
                required:true,
                // remote:'http://127.0.0.1:8000/validate-email',
            },
        },
        messages:{
            "email":{
                required:"Please enter email",
                // remote: "Email already registered"
            },
        },
    });
});
</script>