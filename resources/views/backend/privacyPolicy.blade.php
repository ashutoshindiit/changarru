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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Edit Page</a></li>
                     </ol>
                  </div>
                  <h4 class="page-title">Edit Page</h4>
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
                              <h4 class="header-title mb-3 pull-left">Edit Page</h4> 
                              <a href="{{url('admin/pages/list')}}" class="btn btn-primary pull-right  mb-3">Back To Pages</a>
                           </div>
                        </div>
                     </div>
                        <form method="post" id="termForm" action="{{url('admin/edit-privacy')}}">
                         <div class="row">
                             @csrf                                        
                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label>Title(English)</label>
                                     <input class="form-control" id="title" name="title" type="text"  value="{{@$privacyPolicy->title}}">    
                                 </div>
                             </div>

                             <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="">Description(English)</label>
                                    <textarea class="form-control textar" id="description_id" name="description_id">{{@$privacyPolicy->description}}</textarea>
                                    <input class="form-control" id="description_hidden_id" name="description" type="hidden" value="{{@$privacyPolicy->description}}">
                                    <label class="error" for="description_hidden_id"></label>
                                 </div>
                             </div>                                
                         </div>

                         <!-- end col-->
                         <div class="row mt-3">
                             <div class="col-12 text-center">
                                 <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Submit</button>
                                 
                                 <a href="{{url('admin/pages/list')}}" type="submit" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> Cancel</a>
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
    $('#termForm').validate({
        ignore:[],
        rules:{
            "title":{
                required:true,
                maxlength:200,
                minlength:5,
            },
            "description":{
                required:true,
                minlength:20,
            },
        },
        messages:{
            "title":{
                required:"Please enter title",
                maxlength:"Maximum 200 characters are allowed",
                minlength:"Title must contain 5 characters",
            },
            "description":{
                required:"Please enter description",
                minlength:"Description must contain 20 characters",
            },
        },
    });
</script>
