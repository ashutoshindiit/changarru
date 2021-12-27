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
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Users</h4>
               </div>
            </div>
         </div>


         <div class="row">
            <div class="col-lg-12">
               <div class="card-box">
                     <form class="form-inline actv_class_refnd" id="search_form" action="" method="get">

                        <div class="filter_div_seler new_div_seler">
                           <div class="search_width">
                              <div class="row">
                                 <div class="col-sm-2">
                                    <p class="text_bold">Search:</p>
                                 </div>

                                 <div class="col-sm-3">
                                    <span class="wd_form">
                                       <select value="" name="verified_status" type="text" class="form-control custom-select sort">
                                           <option selected disabled>Sort User Name <body></body></option>
                                           <option value="verified" <?php if(@$_GET['verified_status'] == 'verified'){echo "selected";}?>>Verified users</option>
                                           <option value="not_verified" <?php if(@$_GET['verified_status'] == 'not_verified'){echo "selected";}?>>Not verified users</option>
                                           <option value="deleted" <?php if(@$_GET['verified_status'] == 'deleted'){echo "selected";}?>>Deleted users</option>
                                       </select>
                                    </span>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="searc_btn text-center mt-3">
                                       <button class="btn btn_theme searchSubmitProductSeller"><span>Search</span></button>
                                       <a href="{{ url('admin/userManagement/user/list') }}"><button class="btn btn_theme reset"><span>Reset</span></button></a>
                                    </div>
                                 </div>
                              </div>

                           </div>
                        </div>
                     </form>
                  <div class="d-flex align-items-center justify-content-between">
                     <h4 class="header-title mb-3 pull-left">Users List</h4> </div>
                  <div class="table-responsive">
                     <table class="table table-borderless table-hover table-nowrap table-centered m-0 dash" id="usersTable">
                        <thead class="thead-light">
                           <tr>
                              <th>Sr. No</th>
                              <th>Mobile Number</th>
                              <!-- <th>Otp</th> -->
                              <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                           		$count = 1;
                           		if(isset($_GET['page']) && $_GET['page']){
                           		   $count = $_GET['page'];
                           		}

                           		$Sno = ($count*10)-10;

                           		foreach ($usersPagination as $key => $value): ?>
                                <tr @if($value["deleted_at"]) style="background-color: coral;" @endif>
                                	<td class="serialUserClass"> {{($key+1) + $Sno}} </td>
                                 	<td> + {{$value['isd_code']}}- {{$value['mobile_number']}} </td>
                                 	<!-- <td> {{$value['otp']}} </td> -->
                                 	<td> {{$value['verified_status']}} </td>
                                    <td> 
                                       <a href="{{url('admin/userManagement/userAddress/list/'.base64_encode($value['id']))}}" class="btn btn-xs btn-success btn-successf"><i class="fa fa-address-card"></i></a>
                                       
                                 	   @if($value['deleted_at']==null)  
                                          <a href="javascript: void(0);" id="userIdDelete" data-id="{{$value['id']}}" class="btn btn-xs btn-danger "><i class="mdi mdi-trash-can"></i></a>
                                       @else
                                          <a href="javascript: void(0);" id="userIdRestore" data-id="{{$value['id']}}" class="btn btn-xs btn-danger "><i class="mdi mdi-autorenew"></i></a>
                                       @endif 
                                    </td>
                              	</tr>
                            <?php endforeach ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="centred"> 
                  {{$usersPagination->links("pagination::bootstrap-4")}} 
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Footer -->
   @include('backend.common.footer')
   
   <script type="text/javascript">
      $(document).on('click', '#userIdDelete', function() {
         event.preventDefault();
         var ths = $(this);
         var id = $(this).data('id');
         var csrf_token = $('meta[name=csrf-token]').attr('content');
         Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
            if(result.isConfirmed) {
               $.ajax({
                  type: "POST",
                  url: "{{url('admin/userManagement/user/delete/')}}/" + id,
                  data: {
                     id: id,
                     _token: csrf_token
                  },
                  success: function(data) {
                     if(data['msg'] = 'true') {
                        Swal.fire('Deleted!', 'User has been deleted.', 'success').then((result) => {
                           ths.parents('tr').remove();
                           $('.serialUserClass').each(function(key, val) {
                              $(this).text(key + 1)
                           })
                           toastr.success('Your data has been deleted');
                           location.reload('admin/userManagement/user/list');

                        })
                     } else {
                        Swal.fire("Cancelled", "Your data is safe :)", "error");
                     }
                  }
               });
            } else {
               Swal.fire("Cancelled", "Your data is safe :)", "error");
            }
         })
      });
   </script>

   <!-- //  restore button -->
   <script type="text/javascript">
      $(document).on('click', '#userIdRestore', function() {
         event.preventDefault();
         var ths = $(this);
         var id = $(this).data('id');
         var csrf_token = $('meta[name=csrf-token]').attr('content');
         Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
         }).then((result) => {
            if(result.isConfirmed) {
               $.ajax({
                  type: "POST",
                  url: "{{url('admin/userManagement/user/restore/')}}/" + id,
                  data: {
                     id: id,
                     _token: csrf_token
                  },
                  success: function(data) {
                     if(data['msg'] = 'true') {
                        Swal.fire('Deleted!', 'User has been restored.', 'success').then((result) => {
                           // ths.parents('tr').remove();
                           ths.parents('tr').css("background-color",'');
                           // $('.serialUserClass').each(function(key, val) {
                           //    $(this).text(key + 1)
                           // })
                           location.reload('admin/userManagement/user/list');
                           toastr.success('User has been restored');
                        })
                     } else {
                        Swal.fire("Cancelled", "Your data is safe :)", "error");
                     }
                  }
               });
            } else {
               Swal.fire("Cancelled", "Your data is safe :)", "error");
            }
         })
      });
   </script>

    <script>
        $(document).on('click', '.searchSubmitProductSeller', function(){
            var start_date  = $('#start_date').val();
            var end_date    = $('#end_date').val();
            var user_id     = $('#user_id').val();

            if(start_date != '' || end_date != ''||user_id!=''){
                $('#search_form').submit(); 
            }else{
                swal('plesae select Date to filter');
            }              
        });
    </script>