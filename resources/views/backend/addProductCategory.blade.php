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
                        <li class="breadcrumb-item"><a href="{{url('admin/productManagement/category/category-list')}}">Product Category</a></li>
                        <li class="breadcrumb-item active">Add Product Categories</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Add Product Category</h4>
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
                              <h4 class="header-title mb-3 pull-left">Add Product Category</h4>
                              <a href="{{url('admin/productManagement/category/category-list')}}" class="btn btn-primary pull-right  mb-3">Back To Product Categories</a>
                           </div>
                        </div>
                     </div>
                     <form id="productCategoryImageForm" action="{{url('admin/productManagement/category/add-category')}}" method="post"  enctype="multipart/form-data" >
                        @csrf
                           <div class="row mb-3">
                              <div class="col-lg-6">
                                 <div class=" profile_user">
                                    <div class="card">
                                       <div class="card-body text-center">
                                          <div class="user-image ">
                                             <img class="rounded-circle img-thumbnail old_image" src="{{asset('frontend/images/default.jpg')}}" >
                                             <label for="user-img">Upload Category Image</label>
                                             <input id="user-img" class="img_upload" name="image" style="display:none" type="file" accept="image/*">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="">Category Name</label>
                                 <input type="text" name="name" value="" class="form-control" />
                              </div>

                           </div>
                           <div class="col-md-6">
                              <div class="form-group mb-3">
                                 <label>Choose Seller</label>
                                 <div class="input-group">
                                    <select class="form-control custom-select" name="seller_id" value="" required="">
                                       <option value="" selected disabled>Choose sellers </option>
                                       @foreach($sellers as $value)
                                       <option value="{{@$value->id}}">{{@$value->buisness_name}} ({{@$value->slug}})</option>
                                       @endforeach              
                                    </select>
                                 </div>
                              </div>
                             <label for="seller_id" class="error"></label>
                           </div>
                           <div class="col-12 text-left">
                              <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fe-check-circle mr-1"></i> Submit
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

