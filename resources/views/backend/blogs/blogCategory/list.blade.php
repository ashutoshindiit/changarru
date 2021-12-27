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
                                            <li class="breadcrumb-item active">Blog Categories</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Blog Category List</h4>
                                </div>
                            </div>
                        </div> 
                   

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                   <div class="row">
                                     <div class="col-md-6">
                                       <h4 class="header-title mb-3">Blog Category List </h4>
                                     </div>
                                     <div class="col-md-6 text-right">
                                        <a href="{{url('admin/add-Category')}}" class="btn btn-primary  mb-3">Add Blog Category</a>
                                     </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table  id="basic-datatable1" class="table  table-hover table-nowrap table-centered m-0">

                                     <thead class="thead-light">
                                                <tr>
                                                    <th>S.no</th>
                                                    <th>Category Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($blogCategories as $key => $value): ?>
                                                 <tr>
                                                    <td>
                                                        {{$key+1}}
                                                    </td>
                                                     <td>
                                                         <h5 class="m-0 font-weight-normal">{{@$value['category_name']}}</h5>
                                                     </td>

                                                     <td> <a href="{{url('/admin/edit-Category/'.@$value['id'])}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>

                                                        <a href="{{url('/admin/delete-blogsCategories/'.@$value['id'])}}"  class="btn btn-xs btn-danger del_btn"><i class="mdi mdi-trash-can"></i></a>

<!--                                                         <a val="{{base64_encode($value['id'])}}" href="javascript: void(0);"  class="btn btn-xs btn-danger del_btn"><i class="mdi mdi-trash-can"></i></a> -->
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

<!--         <script>
            $(document).on('click','.del_btn',function(){
                var confirmation =  confirm('Are you sure you want to delete this?');
                var userId = $(this).attr("val");
                var ev        = $(this);
                if(confirmation == true){
                    $.ajax({
                         url: "{{ url('admin/delete-blogsCategories') }}" + '/' + userId,
                        type: 'POST',
                       data : {"_token":"{{ csrf_token() }}"},  //pass the CSRF_TOKEN()
                     success: function (data) {
                            if (data.status == 'ok') {
                                $(ev).closest('tr').hide();
                                toastr.success('User deleted successfully');
                            }   
                        }         
                    });
                }else{
                    return false;
                }
            });
        </script> -->