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
                                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/cms-page')}}">Cms Pages</a></li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/changarru-testimonial')}}">Changarru Testimonial</a></li>
                                            <li class="breadcrumb-item active">{{@$testimonial['title']?'Edit Testimonial':'Add Testimonial'}} </li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">{{@$testimonial['title']?'Edit Testimonial':'Add Testimonial'}}</h4>
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
                                                <a href="{{url('admin/changarru-testimonial')}}" class="btn btn-primary  mb-3">Back To Testimonial</a>
                                            </div>
                                        </div>
                                        <form action="{{url('admin/add-changarru-testimonial/'.@$id)}}" id="add_testimonial" method="post" enctype="multipart/form-data" >
                                        @csrf

                                        <div class="row mb-3">
                                           <div class="col-lg-6">
                                              <div class=" profile_user">
                                                 <div class="card">
                                                    <div class="card-body text-center">
                                                       <div class="user-image ">
                                                          <img class="rounded-circle img-thumbnail old_image" src="{{@$sellerCategories['image']?asset('frontend/assets/img/productCategoryImage/'.@$sellerCategories['image']):asset('frontend/images/default.jpg')}}" >
                                                          <label for="user-img">Upload Category Image</label>
                                                          <input id="user-img" class="img_upload" name="image" style="display:none" type="file" accept="image/*">
                                                       </div>
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{old('title')?:@$testimonial['title']}}" >
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class=""> Description</label>
                                                    <textarea class="form-control textar"  id="description_id" name="description">{{@$testimonial->description}}</textarea>
                                                    <input class="form-control" id="description_hidden_id" name="description" type="hidden" value="{{@$testimonial['description']}}">
                                                    <label class="error" for="description_hidden_id"></label>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Submit</button>
                                                    <a href="{{url('/admin/hagel-services')}}"><button type="submit" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</button></a>
                                                </div>
                                            </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                    </div> <!-- container -->
                </div> <!-- content -->

               @include('backend.common.footer')
           </div>
       </div>
       <div class="rightbar-overlay"></div>

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


<script type="text/javascript">
    $(document).ready(function(){
        function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('.old_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('.img_upload').change(function(){
            var img_name = $(this).val();
            if(img_name != '' && img_name != null){
                var img_arr = img_name.split('.');
                var ext = img_arr.pop();
                ext = ext.toLowerCase();
                // alert(ext); return false;
                if(ext == 'jpeg' || ext == 'jpg' || ext == 'png'){
                    input = document.getElementById('img_upload');
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
    $('#add_testimonial').validate({
        ignore:[],
        rules:{
            "title":{
                required:true,
                maxlength:200,
                minlength:5
            },
            "description":{
                required:true,
                minlength:20
            },
        },
        messages:{
            "title":{
                required:"Please enter title",
                maxlength:"Maximum 200 characters are allowed",
                minlength:"Title must contain 5 characters"
            },
            "description":{
                // required:"Please enter description",
                required:"Please enter description",
                minlength:"Feature description must contain 20 characters"
            },
        },
    });
</script>

