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
                        <li class="breadcrumb-item active">Edit Homepage Information</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Edit Homepage Information</h4>
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
                              <h4 class="header-title mb-3 pull-left">Edit Homepage Information</h4> 
                              <a href="{{url('admin/cms-page')}}" class="btn btn-primary pull-right  mb-3">Back To Cms Pages</a>
                           </div>
                        </div>
                    </div>
                    <form method="post" id="termForm" action="{{url('admin/update-homepage-information')}}" enctype="multipart/form-data" >
                        @csrf    
                        <div class="row">
                            <div class="col-lg-6">
                                <p>Header logo</p>
                                <div class=" profile_user">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="user-image1">
                                                <img id="old_image1" class="rounded-circle img-thumbnail" src="{{@$homepageInformation['header_logo']?asset('frontend/landingPage/assets/images/header-logo/'.@$homepageInformation['header_logo']):asset('frontend/images/default.jpg')}}">
                                                <label for="img_upload_1">Upload Header logo</label>
                                                <input type="file" id="img_upload_1" style="display:none" accept="image/*" name="header_logo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            </br>
                            </br>
                            <div class="col-lg-6">
                                <p>Banner Image 1</p>
                                <div class=" profile_user">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="user-image1">
                                                <img id="old_image" class="rounded-circle img-thumbnail" src="{{@$homepageInformation['banner_image1']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['banner_image1']):asset('frontend/images/default.jpg')}}">
                                                <label for="img_upload">Upload Banner Image 1</label>
                                                <input type="file" id="img_upload" style="display:none" accept="image/*" name="banner_image1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            </br>
                            </br>
                            <div class="col-lg-6">
                                <p>Banner Image 2</p>
                                <div class=" profile_user">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="user-image1">
                                                <img id="old_banner_image" class="rounded-circle img-thumbnail" src="{{@$homepageInformation['banner_image2']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['banner_image2']):asset('frontend/images/default.jpg')}}">
                                                <label for="img_banner_upload">Upload Banner Image 2</label>
                                                <input type="file" id="img_banner_upload" style="display:none" accept="image/*" name="banner_image2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            </br>
                            </br>
                            </br>
                            <div class="col-lg-6">
                                <p>Main Video</p>
                                <div class=" profile_user">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="user-image1">
                                                 <video id="old_video" class=" img-thumbnail" width="260" height="180" controls>
                                                  <source src="{{@$homepageInformation['main_video']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['main_video']):asset('frontend/images/videologo.png')}}" type="video/mp4">
                                                </video> 
                                              <div class="clearfix"></div>
                                                <label for="img_upload_video" >Upload Main Video</label>
                                                <input type="file" style="display:none" id="img_upload_video" accept="video/mp4,video/x-m4v,video/*" name="main_video">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <p>Step 1 Image</p>
                                <div class=" profile_user">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="user-image1">
                                                <img id="old_image_step1" class="rounded-circle img-thumbnail" src="{{@$homepageInformation['step1_image']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['step1_image']):asset('frontend/images/default.jpg')}}">
                                                <label for="img_upload_step1">Upload Step 1 Image</label>
                                                <input type="file" id="img_upload_step1" style="display:none" accept="image/*" name="step1_image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            </br>
                            </br>
                            
                            <div class="col-lg-6">
                                <p>Step 2 Image</p>
                                <div class=" profile_user">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="user-image1">
                                                <img id="old_image_step2" class="rounded-circle img-thumbnail" src="{{@$homepageInformation['step2_image']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['step2_image']):asset('frontend/images/default.jpg')}}">
                                                <label for="img_upload_step2">Upload Step 2 Image</label>
                                                <input type="file" id="img_upload_step2" style="display:none" accept="image/*" name="step2_image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            </br>
                            </br>
                            <div class="col-lg-6">
                                <p>Step 3 Image</p>
                                <div class=" profile_user">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="user-image1">
                                                <img id="old_image_step3" class="rounded-circle img-thumbnail" src="{{@$homepageInformation['step3_image']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['step3_image']):asset('frontend/images/default.jpg')}}">
                                                <label for="img_upload_step3">Upload Step 3 Image</label>
                                                <input type="file" id="img_upload_step3" style="display:none" accept="image/*" name="step3_image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>


                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Video title</label>
                                    <input class="form-control"  name="video_title" type="text"  value="{{@$homepageInformation->video_title}}">    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Blog title</label>
                                    <input class="form-control"  name="blog_title" type="text"  value="{{@$homepageInformation->blog_title}}">    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Category title</label>
                                    <input class="form-control"  name="category_title" type="text"  value="{{@$homepageInformation->category_title}}">    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Testimonial title</label>
                                    <input class="form-control"  name="testimonial_title" type="text"  value="{{@$homepageInformation->testimonial_title}}">    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Page title</label>
                                    <input class="form-control"  name="page_title" type="text"  value="{{@$homepageInformation->page_title}}">    
                                </div>
                            </div>

                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label>Title</label>
                                     <input class="form-control" id="title" name="title" type="text"  value="{{@$homepageInformation->title}}">    
                                 </div>
                             </div>

                             <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="">Description</label>
                                    <textarea class="form-control textar" name="description">{{@$homepageInformation->description}}</textarea>
                                 </div>
                             </div>
                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label>Feature title</label>
                                     <input class="form-control"  name="feature_title" type="text"  value="{{@$homepageInformation->feature_title}}">    
                                 </div>
                             </div>

                             <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="">Feature Description</label>
                                    <textarea class="form-control textar" name="feature_description">{{@$homepageInformation->feature_description}}</textarea>
                                 </div>
                             </div>
                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label>Step1 title</label>
                                     <input class="form-control"  name="step1_title" type="text"  value="{{@$homepageInformation->step1_title}}">    
                                </div>
                            </div>

                            <div class="form-group text-left">
                                <label class="bold_text build_label">Step 1 Information Link Status</label>
                                <div class="wrap_rad_chk1">
                                    <div class="row ">
                                        <div class="col-sm-4">
                                            <div class="custom-control custom-radio ">
                                                <input type="radio" name="see_more_information_step_1_button" class="step1_status_class" value="active" @if($homepageInformation['see_more_information_step_1_button']=='active') checked @endif>
                                                <label  for="pe">Active</label>
                                                <input type="radio" name="see_more_information_step_1_button" class="step1_status_class" value="inactive" @if($homepageInformation['see_more_information_step_1_button']=='inactive') checked @endif>
                                                <label  for="pek">In active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 see_more_information_step_1_name_div @if($homepageInformation['see_more_information_step_1_button']=='inactive') d-none @endif" >
                                 <div class="form-group">
                                     <label>See more information step 1 name</label>
                                     <input class="form-control see_more_information_step_1_name"  name="see_more_information_step_1_name" placeholder="See more information step 1 name" type="text"  value="{{@$homepageInformation->see_more_information_step_1_name}}">    
                                </div>
                            </div>

                            <div class="col-lg-6 see_more_information_step_1_link_div @if($homepageInformation['see_more_information_step_1_button']=='inactive') d-none @endif">
                                 <div class="form-group">
                                     <label>See more information step 1 link</label>
                                     <input class="form-control see_more_information_step_1_link"  name="see_more_information_step_1_link" placeholder="See more information step 1 link" type="text"  value="{{@$homepageInformation->see_more_information_step_1_link}}">    
                                </div>
                            </div>                             
                            
                             <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="">Step1 Description</label>
                                    <textarea class="form-control textar" name="step1_description">{{@$homepageInformation->step1_description}}</textarea>
                                 </div>
                             </div>
                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label>Step2 title</label>
                                     <input class="form-control"  name="step2_title" type="text"  value="{{@$homepageInformation->step2_title}}">    
                                 </div>
                            </div>

                            <div class="form-group text-left">
                                <label class="bold_text build_label">Step 2 Information Link Status</label>
                                <div class="wrap_rad_chk1">
                                    <div class="row ">
                                        <div class="col-sm-4">
                                            <div class="custom-control custom-radio ">
                                                <input type="radio" class="step2_status_class" name="see_more_information_step_2_button" @if($homepageInformation['see_more_information_step_2_button']=='active') checked @endif value="active">
                                                <label  for="pe2">Active</label>
                                                <input type="radio" class="step2_status_class" @if($homepageInformation['see_more_information_step_2_button']=='inactive') checked @endif name="see_more_information_step_2_button" value="inactive">
                                                <label  for="pek2">In active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 see_more_information_step_2_name_div @if($homepageInformation['see_more_information_step_2_button']=='inactive') d-none @endif">
                                 <div class="form-group">
                                     <label>See more information step 2 name</label>
                                     <input class="form-control see_more_information_step_2_name"  name="see_more_information_step_2_name" placeholder="See more information step 2 name" type="text"  value="{{@$homepageInformation->see_more_information_step_2_name}}">    
                                </div>
                            </div>

                            <div class="col-lg-6 see_more_information_step_2_link_div @if($homepageInformation['see_more_information_step_2_button']=='inactive') d-none @endif">
                                  <div class="form-group">
                                      <label>See more information step 2 link</label>
                                      <input class="form-control see_more_information_step_2_link"  name="see_more_information_step_2_link" type="text"  value="{{@$homepageInformation->see_more_information_step_2_link}}" placeholder="See more information step 2 link">    
                                 </div>
                             </div>
                            
                             <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="">Step2 Description</label>
                                    <textarea class="form-control textar" name="step2_description">{{@$homepageInformation->step2_description}}</textarea>
                                 </div>
                             </div>
                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label>Step3 title</label>
                                     <input class="form-control"  name="step3_title" type="text"  value="{{@$homepageInformation->step3_title}}">    
                                 </div>
                            </div>
                            
                            <div class="form-group text-left">
                                <label class="bold_text build_label">Step 3 Information Link Status</label>
                                <div class="wrap_rad_chk1">
                                    <div class="row ">
                                        <div class="col-sm-4">
                                            <div class="custom-control custom-radio ">
                                                <input type="radio" class="step3_status_class" name="see_more_information_step_3_button" @if($homepageInformation['see_more_information_step_3_button']=='active') checked @endif  value="active">
                                                <label  for="pe3">Active</label>
                                                <input type="radio" @if($homepageInformation['see_more_information_step_3_button']=='inactive') checked @endif class="step3_status_class" name="see_more_information_step_3_button" value="inactive">
                                                <label  for="pek3">In active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <div class="col-lg-6 see_more_information_step_3_name_div @if($homepageInformation['see_more_information_step_3_button']=='inactive') d-none @endif">
                                 <div class="form-group">
                                     <label>See more information step 3 name</label>
                                     <input class="form-control see_more_information_step_3_name"  name="see_more_information_step_3_name" placeholder="See more information step 3 name" type="text"  value="{{@$homepageInformation->see_more_information_step_3_name}}">    
                                </div>
                            </div>

                            <div class="col-lg-6 see_more_information_step_3_link_div @if($homepageInformation['see_more_information_step_3_button']=='inactive') d-none @endif">
                                  <div class="form-group">
                                      <label>See more information step 3 link</label>
                                      <input class="form-control see_more_information_step_3_link"  name="see_more_information_step_3_link" placeholder="See more information step 3 link" type="text"  value="{{@$homepageInformation->see_more_information_step_3_link}}">    
                                 </div>
                             </div>


                             <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="">Step3 Description</label>
                                    <textarea class="form-control textar" name="step3_description">{{@$homepageInformation->step3_description}}</textarea>
                                 </div>
                             </div>

                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label>App title</label>
                                     <input class="form-control"  name="app_title" type="text"  value="{{@$homepageInformation->app_title}}">    
                                 </div>
                             </div>
                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label>App Description</label>
                                     <input class="form-control"  name="app_description" type="text"  value="{{@$homepageInformation->app_description}}">    
                                 </div>
                             </div>
                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label>Google play store link</label>
                                     <input class="form-control"  name="google_play_store_link" type="text"  value="{{@$homepageInformation->google_play_store_link}}">    
                                 </div>
                             </div>
                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label>Apple play store link</label>
                                     <input class="form-control"  name="apple_play_store_link" type="text"  value="{{@$homepageInformation->apple_play_store_link}}">    
                                 </div>
                             </div>
                             
                             <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="">Footer Drescription</label>
                                    <textarea class="form-control textar" name="footer_description">{{@$homepageInformation->footer_description}}</textarea>
                                 </div>
                             </div>

                         </div>

                         <!-- end col-->
                         <div class="row mt-3">
                             <div class="col-12 text-center">
                                 <button type="submit" class="btn btn-success waves-effect waves-light m-1 homepageInfoSubmit"><i class="fe-check-circle mr-1"></i> Submit</button>

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
    
    <script type="text/javascript">
        $(document).on('click','.homepageInfoSubmit',function(e){
            e.preventDefault();
            var error = 0;
            var focus = '';
            if ($('#termForm').valid()) {
                if ($('input[name=see_more_information_step_1_button]:checked').val()=='active') {
                   
                   if($('.see_more_information_step_1_name').val()==''){
                      error=1;
                      $('.see_more_information_step_1_name').after('<label for="step2_title" class="error">Please enter see more information step 1 name</label>')
                      focus = '.see_more_information_step_1_name';

                   } 

                   if($('.see_more_information_step_1_link').val()==''){
                    error=1
                      $('.see_more_information_step_1_link').after('<label for="step2_title" class="error">Please enter see more information step 1 link</label>')
                      focus = '.see_more_information_step_1_link';
                   }

                }

                if ($('input[name=see_more_information_step_2_button]:checked').val()=='active') {

                    if($('.see_more_information_step_2_name').val()==''){
                       error=1;
                       $('.see_more_information_step_2_name').after('<label for="step2_title" class="error">Please enter see more information step 2 name</label>')
                       focus = '.see_more_information_step_2_name';

                    } 

                    if($('.see_more_information_step_2_link').val()==''){
                     error=1
                       $('.see_more_information_step_2_link').after('<label for="step2_title" class="error">Please enter see more information step 2 link</label>')
                       focus = '.see_more_information_step_2_link';
                    } 
                }

                if ($('input[name=see_more_information_step_3_button]:checked').val()=='active') {
                    // if($('.see_more_information_step_3_name').val()=='' && $('.see_more_information_step_3_link').val()==''){

                    // }
                    if($('.see_more_information_step_3_name').val()==''){
                       error=1;
                       $('.see_more_information_step_3_name').after('<label for="step2_title" class="error">Please enter see more information step 3 name</label>')
                       focus = '.see_more_information_step_3_name';

                    } 

                    if($('.see_more_information_step_3_link').val()==''){
                     error=1
                       $('.see_more_information_step_3_link').after('<label for="step2_title" class="error">Please enter see more information step 3 link</label>')
                       focus = '.see_more_information_step_3_link';
                    } 
                }

                if(focus){
                    $(focus).focus();
                }
                console.log(error)
                if(error==1){
                    return false;
                }else{
                    $('#termForm').submit();
                }
            }
        });
        
    </script>

    <script type="text/javascript">
        $(document).on('click','.step1_status_class',function(){
            console.log($(this).val());
            step1 = $(this).val();
            if($(this).val()=='inactive'){                
                $('.see_more_information_step_1_name').val('');
                $('.see_more_information_step_1_link').val('');

                $('.see_more_information_step_1_name_div').hide();
                $('.see_more_information_step_1_link_div').hide();

            }else{
                console.log('here 1')
                $('.see_more_information_step_1_name_div').removeClass('d-none');
                $('.see_more_information_step_1_link_div').removeClass('d-none');

                $('.see_more_information_step_1_name_div').show();
                $('.see_more_information_step_1_link_div').show();
            }
        });
    </script>


    <script type="text/javascript">
        $(document).on('click','.step2_status_class',function(){
            console.log($(this).val());
            step2 = $(this).val();
            if($(this).val()=='inactive'){
                $('.see_more_information_step_2_name').val('');
                $('.see_more_information_step_2_link').val('');

                $('.see_more_information_step_2_name_div').hide();
                $('.see_more_information_step_2_link_div').hide();
            }else{
                console.log('here 2')
                $('.see_more_information_step_2_name_div').removeClass('d-none');
                $('.see_more_information_step_2_link_div').removeClass('d-none');

                $('.see_more_information_step_2_name_div').show();
                $('.see_more_information_step_2_link_div').show();
            }
        });
    </script>

    <script type="text/javascript">
        $(document).on('click','.step3_status_class',function(){
            console.log($(this).val());
            step3 = $(this).val();
            if($(this).val()=='inactive'){
                $('.see_more_information_step_3_name').val('');
                $('.see_more_information_step_3_link').val('');

                $('.see_more_information_step_3_name_div').hide();
                $('.see_more_information_step_3_link_div').hide();
            }else{
                console.log('here 3')
                $('.see_more_information_step_3_name_div').removeClass('d-none');
                $('.see_more_information_step_3_link_div').removeClass('d-none');

                $('.see_more_information_step_3_name_div').show();
                $('.see_more_information_step_3_link_div').show();
            }
        });
    </script>

<script type="text/javascript">
    $(document).ready(function(){
        function readURL0(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#old_image1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#img_upload_1').change(function(){
            var img_name = $(this).val();
            if(img_name != '' && img_name != null){
                var img_arr = img_name.split('.');
                var ext = img_arr.pop();
                ext = ext.toLowerCase();
                if(ext == 'jpeg' || ext == 'jpg' || ext == 'png'){
                    input = document.getElementById('img_upload_1');
                    readURL0(this);
                }
            } else{
                $(this).val('');
                alert('Please select an image of .jpeg, .jpg, .png file format.');
            }
        });

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
    $('#termForm').validate({
        ignore:[],
        rules:{

            "video_title":{
                required:true,
            },
            "blog_title":{
                required:true,
            },
            "category_title":{
                required:true,
            },
            "testimonial_title":{
                required:true,
            },    
            "page_title":{
                required:true,
            },
            "title":{
                required:true,
                maxlength:200,
                minlength:5,
            },
            "description":{
                required:true,
                minlength:20,
            },
            "feature_title":{
                required:true,
            },
            "feature_description":{
                required:true,
                minlength:20,
            },
            "step1_title":{
                required:true,
            },
            
            "step1_description":{
                required:true,
                minlength:20,
            },            
            "step2_title":{
                required:true,
            },
            
            "step2_description":{
                required:true,
                minlength:20,
            },
            "step3_title":{
                required:true,
            },
            
            "step3_description":{
                required:true,
                minlength:20,
            },
            "app_title":{
                required:true,
            },
            "app_description":{
                required:true,
            },
            "apple_play_store_link":{
                required:true,
            },
            "step3_title":{
                required:true,
            },
            "footer_description":{
                required:true,
                minlength:20,
            },
        },
        messages:{

            "video_title":{
                required:"Please enter video title",
            },
            "blog_title":{
                required:"Please enter blog title",
            },
            "category_title":{
                required:"Please enter category title",
            },
            "testimonial_title":{
                required:"Please enter testimonial title",
            },
            "page_title":{
                required:"Please enter Page title",
            },
            "title":{
                required:"Please enter title",
                maxlength:"Maximum 200 characters are allowed",
                minlength:"Title must contain 5 characters",
            },
            "description":{
                required:"Please enter description",
                minlength:"Description must contain 20 characters",
            },
            "feature_title":{
                required:"Please enter feature title",
            },
            "feature_description":{
                required:"Please enter feature description",
                minlength:"Feature description must contain 20 characters",
            },
            "step1_title":{
                required:"Please enter step1 title",
            },
            "step1_description":{
                required:"Please enter step1 description",
                minlength:"Step1 description must contain 20 characters",
            },
            "step2_title":{
                required:"Please enter step2 title",
            },
            "step2_description":{
                required:"Please enter step2 description",
                minlength:"Step2 description must contain 20 characters",
            },
            "step3_title":{
                required:"Please enter step3 title",
            },
            "step3_description":{
                required:"Please enter step3 description",
                minlength:"Step3 description must contain 20 characters",
            },
            "app_title":{
                required:"Please enter step2 title",
            },
            "app_description":{
                required:"Please enter step2 title",
            },
            "google_play_store_link":{
                required:"Please enter google play store link",
            },
            "apple_play_store_link":{
                required:"Please enter apple play store link",
            },
            "footer_description":{
                required:"Please enter footer description",
                minlength:"Footer drescription must contain 20 characters",
            },
        },
    });
</script>
