@include('backend.common.header')
@include('backend.common.navbar')
@include('backend.common.leftside-menu')

 <div class="content-page">
   <div class="content">
     <div class="container-fluid">
        <div class="row">
           <div class="col-12">
              <div class="page-title-box">
                 <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                       <li class="breadcrumb-item"><a href="#">Home</a></li>
                       <li class="breadcrumb-item"><a href="#">Change Password</a></li>
                    </ol>
                 </div>
                 <h4 class="page-title">Change Password</h4>
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-12">
              <div class="card">
                 <div class="card-body">
                    <div class="row">
                       <div class="col-lg-12 text-left">
                          <h4 class="header-title mb-3">Update Password</h4>
                       </div>
                    </div>
                    <div class="row">
                        <form id="admin_change_password" action="{{url('admin/change-password')}}" method="post"  enctype="multipart/form-data">
                            @csrf    
                            <div class="row">
                             <!--    <div class="col-lg-12">
                                  <div class="form-group">
                                     <label for="Product Name">Old password</label>
                                     <input type="text" id="Product Name" class="form-control" placeholder="Old password" value="">
                                  </div>
                               </div> -->
                               <div class="col-lg-12">
                                  <div class="form-group">
                                     <label for="Product Name">New password</label>
                                   <input type="password" name="password" id="password" required="" class="form-control new_password" value="" placeholder="Enter Password">
                                  </div>
                               </div>
                               <div class="col-lg-12">
                                  <div class="form-group">
                                     <label for="Product Name">Confirm password</label>
                                      <input type="password" name="confirm_password" value="" required="" class="form-control" placeholder="Enter Password">
                                  </div>
                               </div>
                            </div>
                           <div class="col-lg-12">
                            <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fe-check-circle mr-1"></i> Update Password</button>
                           </div>
                        </form>
                    </div>
                    <!-- end row -->
                    
                 </div>
                 <!-- end card-body -->
              </div>
              <!-- end card-->
           </div>
           <!-- end col-->
        </div>
        <!-- end row-->
     </div>
     <!-- container -->
   </div>
   <!-- content -->

<!-- Header -->
</div>@include('backend.common.footer')


<script type="text/javascript" src="{{url('public/backend/assets/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/backend/assets/js/jquery.validate.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#admin_change_password').validate({
        rules:{
            password:{
                required:true,
                minlength:6,
                maxlength:50
            },
            confirm_password:{
                required:true,
                equalTo:"#password"
            },
        },
        messages:{
            password:{
                required:"Please enter password",
                maxlength:"Maximum 50 characters are allowed",
                minlength:"Password must contain atleast 6 characters",
            },
            confirm_password:{
                required: "Please re-enter password",
                equalTo: "Confirm password did not match with password"
            },
        }
    });
});
</script>