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
                        <li class="breadcrumb-item active">Pages</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Pages</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="card-box">
                  <h4 class="header-title mb-3">All Pages</h4>
                  <a href="{{url('admin/pages/add-page')}}" class="btn btn-primary pull-right  mb-3">Add Page</a>
                  <div class="table-responsive">
                     <table class="table table-borderless table-hover table-nowrap table-centered m-0 dash">
                        <thead class="thead-light">
                           <tr>
                              <th>Sr. No</th>
                              <th>Title </th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($allPage as $key => $value): ?>
                           <tr>
                               <td class="serialPagesClass"> {{$key+1}} </td>
                              <td> {{$value['title']}} </td>
                              <td> 
                                    <a href="{{url('admin/pages/update/'.$value['id'])}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a> 
                                    <a href="{{url('admin/pages/delete/'.$value['id'])}}" id="pageIdDelete" data-id="{{$value['id']}}" class="btn btn-xs btn-danger"><i class="mdi mdi-trash-can"></i></a> 
                              </td>
                           </tr>
                           <?php endforeach ?>
                        </tbody>
                     </table>
                  </div>
                  <div class="text-center">
                      @if(count($allPage)==0)
                        <h3>No Record Found</h3>
                      @endif
                      
                  </div>
               </div>
            </div>
         </div>
         <!-- end col-->
      </div>
      <!-- end row-->
   </div>
   <!-- container -->
</div>
<!-- content -->
<!-- Header -->
@include('backend.common.footer')


<script type="text/javascript">
   $(document).on('click', '#pageIdDelete', function() {
      event.preventDefault();
      var id = $(this).data('id');
      var ths = $(this);

      var csrf_token = $('meta[name=csrf-token]').attr('content');
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
               url: "{{url('admin/pages/delete/')}}/" + id,
               data: {
                  id: id,
                  _token: csrf_token
               },
               success: function(data) {
                  if(data['msg'] = 'true') {
                     Swal.fire('Deleted!', 'Your file has been deleted.', 'success').then((result) => {
                        // setTimeout(function(){
                        //     location.reload();
                        // },2000);    
                        ths.parents('tr').remove();
                        $('.serialPagesClass').each(function(key, val) {
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