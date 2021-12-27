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
                        <li class="breadcrumb-item active">Support</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Support</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card-box">
                  <div class="d-flex align-items-center justify-content-between">
                     <h4 class="header-title mb-3 pull-left">Support List</h4> 
                  </div>
                  <div class="table-responsive">
                     <table class="table table-borderless table-hover table-nowrap table-centered m-0 dash">
                        <thead class="thead-light">
                           <tr>
                              <th class="supportClass">Sr. No</th>
                              <th>Mobile Number</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userSupport as $key => $value): ?>
                                <tr>
                                    <td> {{$key+1}} </td>
                                    <td> {{@$value['user']['mobile_number']}} </td>
                                    <td> {{@$value['title']}} </td>
                                    <td style="width:280px;white-space: break-spaces;"> {{@$value['description']}}. </td>
                                    <td>  
                                        <a href="{{url('admin/support-detail/'.$value['id'])}}" class="btn btn-xs btn-warning"><i class="mdi mdi-eye"></i></a>
                                        <a href="javascript: void(0);" data-id="{{$value['id']}}" id="supportIdDelete" class="btn btn-xs btn-danger"><i class="mdi mdi-trash-can"></i></a>  
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                     </table>
                  </div>

                  <div class="centred"> {{$userSupportPagination->links("pagination::bootstrap-4")}} </div>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
 
@include('backend.common.footer')


<script type="text/javascript">
   $(document).on('click','#supportIdDelete',function(){
      event.preventDefault(); 
      var ths = $(this);
      var id = $(this).data('id');
      var csrf_token  = $('meta[name=csrf-token]').attr('content');
       Swal.fire({
           title: 'Are you sure?',
           text: "You want to delete category!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: "#DD6B55",
           confirmButtonText: 'Yes, delete it!',
           cancelButtonText: "cancel!",
           closeOnConfirm: false,
           closeOnCancel: false
         }).then((result) => {
           if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{url('admin/support/delete/')}}/"+id,
                    data: {id:id,_token:csrf_token},
                    success: function (data) {
                        if(data['msg'] ='true'){
                            console.log(data);
                            Swal.fire(
                              'Deleted!',
                              'Your data has been deleted.',
                              'success'
                            ).then((result) => {
                               ths.parents('tr').remove();
                               $('.supportClass').each(function(key,val){
                                   $(this).text(key+1)
                               })
                               toastr.success('Your data has been deleted');
                            })
                        }else{
                            Swal.fire('NOT Deleted!', "Something blew up.", "error");
                        }
                    }         
                });
           }else {
               Swal.fire("Cancelled", "Your data is safe :)", "error");
           }
       });
   });
</script>