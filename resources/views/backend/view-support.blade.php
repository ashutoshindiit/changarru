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
                        <li class="breadcrumb-item"><a href="{{url('admin/admin-support')}}">Support</a></li>
                     </ol>
                  </div>
                  <h4 class="page-title">View Support</h4>
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
                              <h4 class="header-title mb-3 pull-left">Support Information</h4> 
                              <a href="{{url('admin/admin-support')}}" class="btn btn-primary pull-right  mb-3">Back To Support</a>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-8 offset-2">
                           <div class="profileinfoms usertab mb-3">
                              <h3>Support information</h3>
                              <table class="table">
                                 <tbody>
                                    <tr>
                                       <th scope="row" style="min-width: 250px" class="bgthecolor">Mobile Number</th>
                                       <td>{{@$userSupportDetail['user']['mobile_number']}}</td>
                                    </tr>
                                    <tr>
                                       <th scope="row" style="min-width: 250px" class="bgthecolor">Title</th>
                                       <td>{{@$userSupportDetail['title']}}</td>
                                    </tr>
                                    <tr>
                                       <th scope="row" style="min-width: 250px" class="bgthecolor">Description</th>
                                       <td>{{@$userSupportDetail['description']}}</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
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