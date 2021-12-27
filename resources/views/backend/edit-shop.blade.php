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
                        <li class="breadcrumb-item"><a href="{{url('admin/sellerManagement/seller/list')}}">Shop</a></li>
                        <li class="breadcrumb-item active">Edit Shop</li>

                     </ol>
                  </div>
                  <h4 class="page-title">Edit Shop</h4>
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
                              <h4 class="header-title mb-3 pull-left">Edit Shop</h4> 
                              <a href="{{url('/admin/sellerManagement/seller/list')}}" class="btn btn-primary pull-right  mb-3">Back To Shops</a>
                           </div>
                        </div>
                     </div>
                    <form action="{{url('admin/sellerManagement/seller/update/'.@$seller['id'])}}" id="edit_shop" method="post"  enctype="multipart/form-data" >
                        @csrf
                    <div class="row">
                       <div class="col-lg-6">
                          <div class="form-group">
                             <label for="">Business Name</label>
                             <input type="text" name="buisness_name" class="form-control" value="{{$seller['buisness_name']}}">
                          </div>
                       </div>
                       <input type="hidden" name="seller_id" value="{{$seller['id']}}">
                       <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Buisness Category</label>
                                <div class="input-group">
                                  <select class="form-control custom-select" name="buisness_category_id" required="">
                                        <option value="" selected disabled>Choose Buisness Category  </option>
                                        @foreach($buisnessCategories as $value)
                                           <option value="{{@$value->id}}" @if(@$seller['buisness_category_id']==$value->id) selected @endif>{{@$value->name}}</option>
                                        @endforeach              
                                  </select> 
                                </div>
                            </div>
                            <label for="buisness_category_id" class="error"></label>
                        </div>
                       <div class="col-lg-6">
                          <div class="form-group">
                             <label for="">Phone Number</label>
                             <input disabled="" type="text" name="mobile_number" class="form-control" value="{{$seller['mobile_number']}}">
                          </div>
                       </div>
                       <div class="col-lg-6">
                          <!-- <div class="form-group">
                             <label for="">Status</label>
                             <input type="text" class="form-control" value="{{$seller['verified_status']}}">
                          </div> -->
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <div class="input-group">
                                  <select class="form-control custom-select" name="verified_status" required="">
                                        <option value="" selected disabled >Select Status <body></body></option> 
                                        <option value="verified" 
                                        @if($seller['verified_status'] == 'verified') selected @endif}}>Verified</option>
                                        <option value="not_verified" 
                                        @if($seller['verified_status'] ==  'not_verified') selected @endif}}>Not Verified</option>     
                                  </select> 
                                </div>
                            </div>
                            <label for="buisness_category_id" class="error"></label>
                        </div>
                       
                        <div class="col-12 text-left">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i class="fe-check-circle mr-1"></i> Update
                            </button>
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




