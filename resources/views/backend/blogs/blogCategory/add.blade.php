@include('backend.common.header')
@include('backend.common.navbar')
@include('backend.common.leftside-menu')

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/blogs-categories')}}">Blog Categories</a></li>
                                            <li class="breadcrumb-item active">Edit Categories</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Edit Categories</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <a href="{{url('admin/blogs-categories')}}" class="btn btn-primary  mb-3">Back To Categories</a>
                                            </div>
                                        </div>
                                        <form action="{{url('admin/add-Category/'.@$id)}}" id="add_Category_blog" method="post" enctype="multipart/form-data" >
                                               @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Category Name</label>
                                                    <input type="text" name="category_name" class="form-control" placeholder="Category Name " value="{{old('category_name')?:@$blogCategory['category_name']}}" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="select form-control select2" name="status" aria-hidden="true" required>
                                                         <option value="" selected  >Select Status <body></body></option> 
                                                         <option value="1" 
                                                         @if($blogCategory['status'] == '1') selected @endif}} @if($blogCategory['status']==null) selected @endif>Enable</option>
                                                         <option value="2" 
                                                         @if($blogCategory['status'] ==  '2') selected @endif}}>Disable</option>
                                                     </select>
                                                </div>
                                            </div>

                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Submit</button>
                                                <button type="submit" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</button>
                                            </div>
                                        </div>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                    </div> <!-- container -->
                </div> <!-- content -->

                <!-- Footer Start -->
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


<script type="text/javascript" src="{{url('admin/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('admin/js/jquery.validate.js')}}"></script>
<script type="text/javascript">
    
    
$(document).ready(function(){
    // Blog Category
    $('#add_Category_blog').validate({
        errorElement: 'span',
        rules: {
            category_name: {
                required: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            category_name : "Please enter category",
            status : "Please select Status",
            
        },
       errorPlacement: function (error, element) {
            var type = $(element).attr("type");
            if (type === "radio") {
                // custom placement
                error.insertAfter(element).wrap('<li/>');
            } else if (type === "checkbox") {
                // custom placement
                error.insertAfter(element).wrap('<li/>');
            } else {
                error.insertAfter(element).wrap('<div/>');
            }
        },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      },
      success: function(label,element) {
        label.removeClass('mt-2 text-danger');
        label.remove();
        $(element).parent().removeClass('has-danger');
        $(element).removeClass('form-control-danger')
      },
    });

});
</script>