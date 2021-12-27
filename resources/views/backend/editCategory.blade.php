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
                        <li class="breadcrumb-item"><a href="{{url('admin/categoryManagement/category/list')}}">Business Category</a></li>
                        <li class="breadcrumb-item active">Edit Business Category</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Edit Business Category</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="d-flex align-items-center justify-content-between">
                              <h4 class="header-title mb-3 pull-left">Edit Business Category</h4> 
                              <a href="{{url('admin/categoryManagement/category/list')}}" class="btn btn-primary pull-right  mb-3">Back To Business Categories</a>
                           </div>
                        </div>
                     </div>
                    <form action="{{url('admin/categoryManagement/category/update/'.$id)}}" id="edit_category" method="post"  enctype="multipart/form-data" >
                        @csrf
                        <div class="row">

                            <div class="col-lg-4">
                                 <div class=" profile_user">
                                     <div class="card">
                                         <div class="card-body text-center">
                                             <div class="user-image ">
                                                 <img class="rounded-circle img-thumbnail old_image1" src="{{@$buisnessCategory->image ? asset('public/backend/assets/images/buisness_category_image/'.$buisnessCategory->image):asset('public/backend/assets/images/default.jpg')}}">
                                                 <label for="user-img">Upload Image</label>
                                                 <input id="user-img" class="img_upload1" name="image" style="display:none" type="file">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                            </div>

                            <br>

                            <div class="col-md-12">
                               <div class="form-group">
                                 <label for="">Category Name</label>
                                 <input class="form-control" required="" type="text" name="name" value="{{$buisnessCategory->name}}" />
                               </div>
                            </div>
                           
                            <div class="col-12 text-left">
                               <button type="submit" class="btn btn-success waves-effect waves-light">
                                  <i class="fe-check-circle mr-1"></i> Update
                               </button>
                            </div>
                        </div>
                    </form>
                  </div>
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

@include('backend.common.footer')

<script type="text/javascript">
    $(document).ready(function(){
        function readURL(input)
        {
            if(input.files && input.files[0])
            {
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    $('.old_image1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('.img_upload1').change(function(){
            var img_name = $(this).val();
            if(img_name != '' && img_name != null){
                var img_arr = img_name.split('.');
                var ext = img_arr.pop();
                ext = ext.toLowerCase();
                // alert(ext); return false;
                if(ext == 'jpeg' || ext == 'jpg' || ext == 'png'){
                    input = document.getElementById('img_upload1');
                    readURL(this);
                }
            } else{
                $(this).val('');
                alert('Please select an image of .jpeg, .jpg, .png file format.');
            }
        });
    });
</script>

 <script type="text/javascript">
    $(document).on('click','#shopIdDelete',function(){
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
                                $('.serialShopClass').each(function(key,val){
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


 <script type="text/javascript">    
     $(document).ready(function(){
         $('#edit_category').validate({
             rules: {
                 "name": {
                     required: true
                 },
             },
             messages: {
                 "name":{
                     required:"Plesae enter category name"
                 },
             },
             submitHandler:function(form){
                 form.submit();
             }
         });
     });
 </script>



 