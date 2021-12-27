@include('backend.common.header')
@include('backend.common.navbar')
@include('backend.common.leftside-menu')

<style>
.bootstrap-tagsinput {
    border: 1px solid #ced4da;
    border-radius: .2rem;
    width: 100%;
    padding: 7.5px 12px;
}
.bootstrap-tagsinput span.tag.label.label-info {
    background: #28a745;
    color: #fff;
    padding: 1px 6px;
}.bootstrap-tagsinput input[type="text"]:focus {
    border: none!important;
    outline: none;
}
.bootstrap-tagsinput input[type="text"] {
   height: auto;
    padding: 0;
    font-size: .875rem;
    font-weight: 400;
    color: #6c757d;
    background-clip: padding-box;
    border: 0
}</style>
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
                                            <li class="breadcrumb-item"><a href="{{url('admin/user/list')}}">Blogs</a></li>
                                            <li class="breadcrumb-item active">{{@$blog['title']?'Edit '.$blog['title']:'Add blog'}}</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">{{@$blog['title']?'Edit '.$blog['title']:'Add blog'}}</h4>
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
                                                <a href="{{url('admin/blogs')}}" class="btn btn-primary  mb-3">Back To Blog List</a>
                                            </div>
                                        </div>
                                        <form action="{{url('admin/add-blog/'.@$id)}}" id="add_blog" method="post" enctype="multipart/form-data" >
                                        @csrf
                                        <label>Blog Image <span class="text-danger">*</span></label>
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <div class=" profile_user">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <div class="user-image ">


                                                                <img class="rounded-circle img-thumbnail old_image" src="{{@$blog['feature_image']?asset('public/backend/assets/images/blog/'.$blog['feature_image']):asset('frontend/images/dummy.png')}}">
                                                                <label for="user-img">Upload Blog Image</label>
                                                                <input id="user-img" class="img_upload" name="feature_image" style="display:none" type="file">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <h4 class="headsub">Basic Info</h4> -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Title <span class="text-danger">*</span></label>
                                                    <input type="text" name="title" class="form-control blogTitle" placeholder=" Title" value="{{old('title')?:@$blog['title']}}" >
                                                    @if($errors->has('title'))
                                                        <div class="error">{{ $errors->first('title') }}</div>
                                                    @endif
                                                </div>
                                            </div> 
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Slug <span class="text-danger">*</span> </label>
                                                    <input type="text" name="slug" class="form-control blogSlug" placeholder="Slug" value="{{old('slug')?:@$blog['slug']}}" >
                                                    @if($errors->has('slug'))
                                                        <div class="error">{{ $errors->first('slug') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Category  <span class="text-danger">*</span></label>
                                                    <select class="select form-control select2 blogcategoryClass" name="category_id" aria-hidden="true" required>
                                                         <option value="" selected>Select Category <body></body></option> 
                                                         @foreach($blogCategories as $blogCategory)
                                                             <option value="{{$blogCategory->id}}"@if($blogCategory->id == $blog['category_id'])selected @endif >{{@$blogCategory->category_name}}</option>
                                                         @endforeach
                                                    </select>
                                                    @if($errors->has('category_id'))
                                                        <div class="error">{{ $errors->first('category_id') }}</div>
                                                    @endif
                                                </div>
                                            </div>

<!--                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Meta Title <span class="text-danger">*</span></label>
                                                    <input type="text" multiple="multiple" name="meta_title" @if($blog['meta_title'] ==null) id="metaTitle" @endif class="form-control" placeholder="Meta Title" value="{{old('meta_title')?:@$blog['meta_title']}}" >
                                                    @if($errors->has('meta_title'))
                                                        <div class="error">{{ $errors->first('meta_title') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Meta Tag <span class="text-danger">*</span></label>
                                                    <input type="text" name="meta_tag" class="form-control mul_category" multiple="multiple" value="{{old('meta_tag')?:@$blog['meta_tag']}}">
                                                    @if($errors->has('meta_tag'))
                                                        <div class="error">{{ $errors->first('meta_tag') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label> Meta Description <span class="text-danger">*</span></label>
                                                    <textarea name="meta_description" @if($blog['meta_description'] ==null) id="metaDescription" @endif class="form-control" placeholder=" Meta Description" required >{{old('meta_description')?:@$blog['meta_description']}}</textarea>
                                                    @if($errors->has('meta_description'))
                                                        <div class="error">{{ $errors->first('meta_description') }}</div>
                                                    @endif
                                                </div>
                                            </div> -->

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Content <span class="text-danger">*</span></label>
                                                    <textarea style="" id="editor" class="form-control" placeholder=" Meta Description" required  name="content" required>{{old('content')?:@$blog['content']}}</textarea>
                                                    @if($errors->has('content'))
                                                        <div class="error">{{ $errors->first('content') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Status <span class="text-danger">*</span></label>

                                                    <select class="select form-control select2" name="status" aria-hidden="true" required>
                                                         <option value="" selected>Select Status <body></body></option> 
                                                         <option value="enable" 
                                                         @if($blog['status'] == 'enable') selected @endif}} @if($blog['status']==null) selected @endif>Enable</option>
                                                         <option value="disable" 
                                                         @if($blog['status'] ==  'disable') selected @endif}}>Disable</option>
                                                     </select>
                                                     @if($errors->has('status'))
                                                         <div class="error">{{ $errors->f,lirst('status') }}</div>
                                                     @endif
                                                </div>
                                            </div>
                                        </div>
                                     <!-- end card-body -->
                                    <div class="row mt-3 text-center">
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Submit</button>
                                            <button type="submit" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</button>
                                        </div>
                                    </div>
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
    
        tinymce.init({
            selector: '.textar,.textar1',
            height: 300,
            menubar: true,
            forced_root_block : "", /*to remove auto p tag */
            plugins: [
                'advlist autolink link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media contextmenu paste code','textcolor'
            ],
            toolbar: 'fontsizeselect | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor',
            fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
            image_advtab: true,
            /*to take automatic urls starts*/
            relative_urls: false,
            remove_script_host: false,
            /*to take automatic urls ends*/
            file_browser_callback_types: 'file image media',       
            image_title: true, 
            // enable automatic uploads of images represented by blob or data URIs
            automatic_uploads: true,
            images_upload_url: "{{url('admin/contentManagement/termAndCondtion')}}",

            file_picker_types: 'image media file', 
            setup: function (editor) {
                editor.on('change', function (e) {
                    // alert(editor.getContent());
                    $('textarea[name="'+editor.targetElm.name+'"]').next('input').val($.trim(editor.getContent()));
                });
            },     
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var blobInfo = blobCache.create(id, file);
                    blobCache.add(blobInfo);
                    // alert(blobInfo.blobUri());
                    cb(blobInfo.blobUri(), { title: file.name });
                };

               input.click();
            }
        });
</script>


<!-- Multiple select -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".mul_category").select2({
            tags:true
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('input[name="meta_tag"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });
        
        $('.bootstrap-tagsinput input').on('focus', function() {
            $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
        }).on('blur', function() {
            $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
        });
        
    });

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".blogTitle").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $(".blogSlug").val(Text);        
        });

         $(".blogTitle").keyup(function(){
            var Text = $(this).val();
            $("#metaTitle").val(Text);
            $("#metaDescription").val(Text);        
        });
    });

    $(document).ready(function(){
        // Blog Category
        $('#add_blog').validate({
                errorElement: 'span',
                rules: {
                    title: {
                        required: true,
                    },
                    slug: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    // meta_title: {
                    //     required: true,
                    // },
                    // meta_tag: {
                    //     required: true,
                    // },  
                    // meta_description: {
                    //     required: true,
                    //     maxlength:150,  
                    // },
                    content: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    // slug: {
                    //     required: true,
                    // },
                },
                messages: {
                    title: "Please enter title",
                    slug:  "Please enter slug",
                    category_id : "Please enter category",
                    // meta_title : "Please enter meta title",
                    // meta_tag : "Please enter meta tag",
                    // meta_description : "Please enter meta description",
                    content : "Please specify the content",
                    // maxlength: "BVN must be equal to 11 digits",
                    status : "Please select Status",
                    // slug : "Please specify the slug of blog"

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
                // highlight: function(element, errorClass) {
                //      $(element).parent().addClass('blogcategoryClass')
                //      $(element).addClass('form-control-danger')
                //    },
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