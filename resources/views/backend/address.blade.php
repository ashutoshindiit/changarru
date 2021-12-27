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
                        <li class="breadcrumb-item"><a href="{{url('admin/userManagement/user/list')}}">User</a></li>
                        <li class="breadcrumb-item active">Address</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Address</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card-box">
                  <div class="d-flex align-items-center justify-content-between">
                     <h4 class="header-title mb-3 pull-left">Address List</h4> 
                     <a href="{{url('admin/userManagement/user/list')}}" class="btn btn-primary pull-right  mb-3">Back To Users</a>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-borderless table-hover  table-centered m-0 dash">
                        <thead class="thead-light">
                           <tr>
                              <th>Sr. No</th>
                              <th>User Name </th>
                              <th>Mobile Number </th>
                              <th>Address </th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userAddresses as $key => $value): ?>
                               
                                <tr>
                                    <td class="serialAddressClass"> {{$key+1}} </td>
                                    
                                    <td> @if($value['name']) {{$value['name']}} @else - @endif </td>

                                    <td> @if($value['mobile_number'])  {{$value['isd_code']}} &nbsp {{$value['mobile_number']}} @else - @endif</td>
                                    
                                    <td>  {{$value['address']}},{{$value['city']}},{{$value['pincode']}} </td>
                                    
                                    <td> 
                                        <a href="javascript: void(0);" id="userAdressIdDelete" data-id="{{$value['id']}}" class="btn btn-xs btn-danger "><i class="mdi mdi-trash-can"></i></a> 
                                    </td>
                               </tr>
                            <?php endforeach ?>
                        </tbody>
                     </table>
                  </div>
                           @if(count($userAddresses)==0)
                              <div class="text-center">
                                 <h3>No Record Found</h3>
                              </div>
                           @endif
                  <div class="centred">
                     {{$userAddressesPaginate->links("pagination::bootstrap-4")}}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
 
@include('backend.common.footer')


<script type="text/javascript">

    $(document).on('click','#userAdressIdDelete',function(){
          event.preventDefault(); 
          var ths = $(this);

          var id = $(this).data('id');
          console.log(id)
          var csrf_token  = $('meta[name=csrf-token]').attr('content');
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed) {
               $.ajax({
                  type: "POST",
                  url: "{{url('admin/userManagement/userAddress/delete/')}}/"+id,
                  data: {
                     id: id,
                     _token: csrf_token
                  },
                  success: function(data) {
                     if(data['msg'] = 'true') {
                        Swal.fire('Deleted!', 'Address has been deleted.', 'success').then((result) => {
                           ths.parents('tr').remove();
                           $('.serialAddressClass').each(function(key, val) {
                              $(this).text(key + 1)
                           })
                           toastr.success('Your data has been deleted');
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