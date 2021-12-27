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
                                           
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">Blogs</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Blog List</h4>
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                   <div class="row">
                                     <div class="col-md-6">
                                       <h4 class="header-title mb-3">Blog List </h4>
                                     </div>
                                     <div class="col-md-6 text-right">
                                        <a href="{{url('admin/add-blog')}}" class="btn btn-primary  mb-3">Add Blog</a>
                                     </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table  id="basic-datatable1" class="table  table-hover table-nowrap table-centered m-0">


                                     <thead class="thead-light">
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Title</th>
                                                    <th>Category Name</th>
                                                    <th>Content Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($blogs as $key => $value): ?>
                                                 <tr>
                                                    <?php
                                                       $contentDescription =  substr($value['content'], 0, 50);
                                                    ?>

                                                    <td class="blogClass">{{$key+1}}</td>
                                                    <td><h5 class="m-0 font-weight-normal">{{@$value['title']}}</h5></td>
                                                    <td><h5 class="m-0 font-weight-normal">{{@$value['blogCategory']['category_name']}}</h5></td>
                                                    <td><h5 class="m-0 font-weight-normal">{{@$contentDescription}}</h5></td>
                                                    <td> 
                                                        <a href="{{url('/admin/edit-blog/'.@$value['id'])}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>

                                                        <a val="{{base64_encode($value['id'])}}" data-id="{{base64_encode($value['id'])}}" href="javascript: void(0);"  class="btn btn-xs btn-danger del_btnBlog"><i class="mdi mdi-trash-can"></i></a>

                                                    </td>
                                                 </tr>
                                                 <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> 
                        
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12  text-center">
                               &copy; Copyright 2021 Hagel Team. All Rights Reserved
                            </div>
                          
                        </div>
                    </div>
                </footer>
                    @include('backend.common.footer')
                </div>
            </div>
            <div class="rightbar-overlay"></div>

        <script type="text/javascript">
           $(document).on('click','.del_btnBlog',function(){
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
                            url: "{{ url('admin/delete-blog') }}" + '/' + id,
                            data: {id:id,_token:csrf_token},
                            success: function (data) {
                                if(data['msg'] ='true'){
                                    console.log(data);
                                    Swal.fire(
                                      'Deleted!',
                                      'Blog has been deleted.',
                                      'success'
                                    ).then((result) => {
                                       // setTimeout(function(){
                                       //     location.reload();
                                       // },2000);    
                                       ths.parents('tr').remove();
                                       $('.blogClass').each(function(key,val){
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
            
<!--         <script>
            $(document).on('click','.del_btn',function(e){
                e.preventDefault();
                var confirmation =  confirm('Are you sure you want to delete this?');
                var blogId = $(this).attr("val");
                var ev        = $(this);
                if(confirmation == true){
                    $.ajax({
                         url: "{{ url('admin/delete-blog') }}" + '/' + blogId,
                        type: 'POST',
                       data : {"_token":"{{ csrf_token() }}"},  //pass the CSRF_TOKEN()
                     success: function (data) {
                            if (data.status == 'ok') {
                                // alert('success');
                                $(ev).closest('tr').hide();
                                toastr.success('blog deleted successfully');
                                 blogs
                                setTimeout(function(){
                                     window.location ='https://hagel-team.com/admin/blogs'; 
                                }, 2000);

                            }else{
                                toastr.success('Something went wrong');
                            }   
                        }         
                    });
                }else{
                    return false;
                }
            });
        </script> -->