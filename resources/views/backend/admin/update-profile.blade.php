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
                                <li class="breadcrumb-item"><a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Update Profile</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Update Profile</h4>
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
                                        <h4 class="header-title mb-3 pull-left">Update Profile</h4>
                                    </div>
                                </div>
                            </div>
                            <form id="admin_personal_form" action="{{url('admin/update-profile')}}" method="post"  enctype="multipart/form-data" >
                                @csrf
                                <div class="col-lg-4">
                                    <div class=" profile_user">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div class="user-image ">
                                                    <img class="rounded-circle img-thumbnail old_image" src="{{@$userList['image']?asset('public/backend/assets/images/profile/'.$userList['image']):asset('public/backend/assets/images/default.jpg')}}">
                                                    <label for="user-img">Upload Image</label>
                                                    <input id="user-img" class="img_upload" name="image" style="display:none" type="file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" id="fullNameId" name="full_name" value="{{@$userList['full_name']}}" class="form-control" placeholder="Enter your full name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" id="emailAddressId" name="email" value="{{@$userList['email']}}" class="form-control" placeholder="Enter your email address">
                                            </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Mobile</label>
                                            <input type="text" id="mobile_number_id" class="form-control" placeholder="Enter your mobile number" name="mobile_number" value="{{@$userList['mobile_number']}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" id="address_id" class="form-control" placeholder="Enter your address" name="address" value="{{@$userList['address']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-left text-centre">
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Update Profile</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>@include('backend.common.footer')


<script type="text/javascript" src="{{url('public/backend/assets/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/backend/assets/js/jquery.validate.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        function readURL(input)
        {
            if(input.files && input.files[0])
            {
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    $('.old_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('.img_upload').change(function(){
            var img_name = $(this).val();
            if(img_name != '' && img_name != null)
            {
                var img_arr = img_name.split('.');
                var ext = img_arr.pop();
                ext = ext.toLowerCase();
                // alert(ext); return false;
                if(ext == 'jpeg' || ext == 'jpg' || ext == 'png')
                {
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
    $(document).ready(function(){
        $('#admin_personal_form').validate({
            rules: {
                full_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                    // remote:'http://127.0.0.1:8000/validate-email'
                },
                mobile_number: {
                    required: true
                },
                address:{
                    required:true
                },
            },
            messages: {
                full_name: {
                    required: "Please enter your full name"
                },
                email: {
                    required: "Please enter your email",
                    email : "Please enter a valid email"
                },
                mobile_number:{
                    required:"Please enter mobile number"
                },
                address: {
                    required: "Plaese enter address"
                },
            },
       
        });
    });

</script>