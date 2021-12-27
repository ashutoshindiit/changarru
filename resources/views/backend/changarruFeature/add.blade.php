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
                                            <li class="breadcrumb-item"><a href="{{url('admin/cms-page')}}">Cms Pages</a></li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/changarru-feature')}}">Features</a></li>
                                            <li class="breadcrumb-item active">{{@$changarruFeature['feature_name']?'Edit Feature':'Add Feature'}}</li>

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Feature List</h4>
                                </div>
                            </div>
                        </div> 

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">{{@$changarruFeature['feature_name']?'Edit Feature':'Add Feature'}}</h4>
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
                                                <a href="{{url('admin/changarru-feature')}}" class="btn btn-primary  mb-3">Back To Feature</a>
                                            </div>
                                        </div>
                                        <form action="{{url('admin/add-changarru-feature/'.@$id)}}" id="add_service" method="post" enctype="multipart/form-data" >
                                        @csrf
                                        <label>Feature Image <span class="text-danger">*</span></label>
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <div class=" profile_user">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <div class="user-image ">
                                                               <img class="rounded-circle img-thumbnail old_image" src="{{@$changarruFeature['image']?asset('admin/assets/img/Changarrufeature/'.$changarruFeature['image']):asset('frontend/images/default.jpg')}}">
                                                               <label for="user-img">Upload feature image</label>
                                                               <input id="user-img" class="img_upload" name="image" style="display:none" type="file">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Feature Name</label>
                                                    <input type="text" name="feature_name" class="form-control" placeholder="Enter feature name " value="{{old('feature_name')?:@$changarruFeature['feature_name']}}" >
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="">Feature Description</label>
                                                    <textarea class="form-control textar"  id="description_id" name="description_id">{{@$changarruFeature->feature_description}}</textarea>
                                                    <input class="form-control" id="description_hidden_id" name="feature_description" type="hidden" value="{{@$changarruFeature['feature_description']}}">
                                                    <label class="error" for="description_hidden_id"></label>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Submit</button>
                                                    <a href="{{url('/admin/changarru-feature')}}"><button type="submit" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</button></a>
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
    $('#add_service').validate({
        ignore:[],
        rules:{
            "feature_name":{
                required:true,
                maxlength:200,
                minlength:5
            },
            "feature_description":{
                required:true,
                minlength:20
            },
        },
        messages:{
            "feature_name":{
                // required:"Please enter title",
                required:"Please enter feature name",
                maxlength:"Maximum 200 characters are allowed",
                minlength:"Title must contain 5 characters"
            },
            "feature_description":{
                // required:"Please enter description",
                required:"Please enter feature description",
                minlength:"Description must contain 20 characters"
            },
        },
    });
</script>

