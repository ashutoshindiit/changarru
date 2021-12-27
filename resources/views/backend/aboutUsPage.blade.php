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
                        <li class="breadcrumb-item active">Edit About Us Information</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Edit About Us Information</h4>
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
                              <h4 class="header-title mb-3 pull-left">Edit About Us Information</h4> 
                              <a href="{{url('admin/cms-page')}}" class="btn btn-primary pull-right  mb-3">Back To Pages</a>
                           </div>
                        </div>
                     </div>
                        <form method="post" id="aboutUSForm" action="{{url('admin/edit-about-us-page')}}" enctype="multipart/form-data" >
                        @csrf    

                         <div class="row">
                            <div class="col-lg-6">
                                <p>Image 1</p>
                                <div class=" profile_user">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="user-image1">
                                                <img id="old_image" class="rounded-circle img-thumbnail" src="{{@$adminContactInformation['image_1']?asset('public/backend/assets/images/adminImage/'.@$adminContactInformation['image_1']):asset('frontend/images/default.jpg')}}">
                                                <label for="img_upload">Upload Image 1</label>
                                                <input type="file" id="img_upload" style="display:none" accept="image/*" name="image_1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            </br>
                            </br>
                            <div class="col-lg-6">
                                <p>Image 2</p>
                                <div class=" profile_user">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="user-image1">
                                                <img id="old_banner_image" class="rounded-circle img-thumbnail" src="{{@$adminContactInformation['image_2']?asset('public/backend/assets/images/adminImage/'.@$adminContactInformation['image_2']):asset('frontend/images/default.jpg')}}">
                                                <label for="img_banner_upload">Upload Banner Image 2</label>
                                                <input type="file" id="img_banner_upload" style="display:none" accept="image/*" name="image_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            </br>
                            </br>
                            </br>
                             <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="">Image Description 1</label>
                                    <textarea class="form-control textar" name="image1_description">{{@$adminContactInformation->image_description_1}}</textarea>
                                 </div>
                             </div>

                             <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="">Image Description 2</label>
                                    <textarea class="form-control textar" name="image2_description">{{@$adminContactInformation->image_description_2}}</textarea>
                                 </div>
                             </div>
                         </div>

                         <!-- end col-->
                         <div class="row mt-3">
                             <div class="col-12 text-center">
                                 <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Submit</button>
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
        function readURL1(input)
        {
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#old_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#img_upload').change(function(){
            var img_name = $(this).val();
            if(img_name != '' && img_name != null){
                var img_arr = img_name.split('.');
                var ext = img_arr.pop();
                ext = ext.toLowerCase();
                if(ext == 'jpeg' || ext == 'jpg' || ext == 'png'){
                    input = document.getElementById('img_upload');
                    readURL1(this);
                }
            } else{
                $(this).val('');
                alert('Please select an image of .jpeg, .jpg, .png file format.');
            }
        });

        function readURL4(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#old_image_step1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        $('#img_upload_step1').change(function(){
            var img_name = $(this).val();
            if(img_name != '' && img_name != null){
                var img_arr = img_name.split('.');
                var ext = img_arr.pop();
                ext = ext.toLowerCase();
                if(ext == 'jpeg' || ext == 'jpg' || ext == 'png'){
                    input = document.getElementById('img_upload_step1');
                    readURL4(this);
                }
            } else{
                $(this).val('');
                alert('Please select an image of .jpeg, .jpg, .png file format.');
            }
        });

        function readURL5(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#old_image_step2').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        $('#img_upload_step2').change(function(){
            var img_name = $(this).val();
            if(img_name != '' && img_name != null){
                var img_arr = img_name.split('.');
                var ext = img_arr.pop();
                ext = ext.toLowerCase();
                if(ext == 'jpeg' || ext == 'jpg' || ext == 'png'){
                    input = document.getElementById('img_upload_step2');
                    readURL5(this);
                }
            } else{
                $(this).val('');
                alert('Please select an image of .jpeg, .jpg, .png file format.');
            }
        });

        function readURL6(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#old_image_step3').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        $('#img_upload_step3').change(function(){
            var img_name = $(this).val();
            if(img_name != '' && img_name != null){
                var img_arr = img_name.split('.');
                var ext = img_arr.pop();
                ext = ext.toLowerCase();
                if(ext == 'jpeg' || ext == 'jpg' || ext == 'png'){
                    input = document.getElementById('img_upload_step3');
                    readURL6(this);
                }
            } else{
                $(this).val('');
                alert('Please select an image of .jpeg, .jpg, .png file format.');
            }
        });

    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        function readURL3(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    $('#old_banner_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#img_banner_upload').change(function(){
            var img_name = $(this).val();
            if(img_name != '' && img_name != null){
                var img_arr = img_name.split('.');
                var ext = img_arr.pop();
                ext = ext.toLowerCase();
                if(ext == 'jpeg' || ext == 'jpg' || ext == 'png'){
                    input = document.getElementById('img_banner_upload');
                    readURL3(this);
                }
            } else{
                $(this).val('');
                alert('Please select an image of .jpeg, .jpg, .png file format.');
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        function readURL2(input1){
            if(input1.files && input1.files[0]){
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    $('#old_video').attr('src', e.target.result);
                }
                reader.readAsDataURL(input1.files[0]);
            }
        }

        $('#img_upload_video').change(function(){
            var img_name = $(this).val();
            if(img_name != '' && img_name != null){
                var img_arr = img_name.split('.');
                var ext = img_arr.pop();
                ext = ext.toLowerCase();
                if(ext == 'mp4' || ext == 'MOV' || ext == 'AVI'|| ext == 'WMV'){
                    input = document.getElementById('img_upload_video');
                    readURL2(this);
                }
            } else{
                $(this).val('');
                alert('Please select an video of .mp4, .mov, .avi file format.');
            }
        });
    });
</script>
    

<script src="{{ url('public/backend/assets/js/tinymce/tinymce.min.js')}}"></script>

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
    $('#aboutUSForm').validate({
        ignore:[],
        rules:{
            "image1_description":{
                required:true,
                minlength:20,
            },
            "image2_description":{
                required:true,
                minlength:20,
            },
        },
        messages:{
            "image1_description":{
                required:"Please enter image description 1",
                minlength:"Image description 1 must contain 20 characters",
            },
            "image2_description":{
                required:"Please enter  image description 2",
                minlength:"Image description 2 must contain 20 characters",
            },

        },
    });
</script>
