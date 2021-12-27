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
                        <li class="breadcrumb-item active">Business Categories</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Business Categories</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card-box">
                  <div class="d-flex align-items-center justify-content-between">
                     <h4 class="header-title mb-3 pull-left">Business Categories List</h4> 
                     <a href="{{url('/admin/categoryManagement/category/add')}}" class="btn btn-primary pull-right  mb-3">Add Business Category</a>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-borderless table-hover table-nowrap table-centered m-0 dash">
                        <thead class="thead-light">
                           <tr>
                              <th>Sr. No</th>
                              <th>Category Name </th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($categoriesPagination as $key => $value): ?>
                            <tr>
                               <td class="categoryShopClass"> {{$key+1}} </td>
                                <td> {{$value->name}} </td>
                                <td>  
                                    <a href="{{url('admin/categoryManagement/category/update/'.$value->id)}}" class="btn btn-xs btn-success btn-successf"><i class="mdi mdi-pencil"></i></a> 
                                    <a href="javascript: void(0);" data-id="{{$value->id}}" id="categoryIdDelete" class="btn btn-xs btn-danger "><i class="mdi mdi-trash-can"></i></a> 
                                </td>
                            </tr>

                           <?php endforeach ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="centred"> {{$categoriesPagination->links("pagination::bootstrap-4")}} </div>
               
            </div>
         </div>
      </div>
   </div>
 
@include('backend.common.footer')

<script type="text/javascript">
   $(document).on('click','#categoryIdDelete',function(){
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
                    url: "{{url('admin/categoryManagement/category/delete/')}}/"+id,
                    data: {id:id,_token:csrf_token},
                    success: function (data) {
                        if(data['msg'] ='true'){
                            console.log(data);
                            Swal.fire(
                              'Deleted!',
                              'Your data has been deleted.',
                              'success'
                            ).then((result) => {
                               // setTimeout(function(){
                               //     location.reload();
                               // },2000);    
                               ths.parents('tr').remove();
                               $('.categoryShopClass').each(function(key,val){
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