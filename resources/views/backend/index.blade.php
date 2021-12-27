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
                        <li class="breadcrumb-item active">Dashboard</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Dashboard</h4>
               </div>
            </div>
         </div>
         <!-- icon problem -->
         <div class="row">
            <div class="col-md-3 col-xl-3">
               <div class="widget-rounded-circle card-box">
                  <div class="row">
                     <div class="col-4">
                        <div class="avatar-lg rounded-circle bg-primary border-primary border"> <i class="fe-users font-22 avatar-title text-white"></i> </div>
                     </div>
                     <div class="col-8">
                        <div class="text-right">
                           <h3 class="mt-1"><span>{{@$users->count()}}</span></h3>
                           <p class="text-muted mb-1 text-truncate">Users</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-xl-3">
               <div class="widget-rounded-circle card-box">
                  <div class="row">
                     <div class="col-4">
                        <div class="avatar-lg rounded-circle bg-success border-success border">
                        <i class="fa fa-shopping-basket font-22 avatar-title text-white"></i>
                        </div>
                     </div>
                     <div class="col-8">
                        <div class="text-right">
                           <h3 class="text-dark mt-1"><span>{{@$sellers->count()}}</span></h3>
                           <p class="text-muted mb-1 text-truncate"> Shops</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-xl-3">
               <div class="widget-rounded-circle card-box">
                  <div class="row">
                     <div class="col-4">
                        <div class="avatar-lg rounded-circle bg-danger border-danger border">
                        <i class="fa fa-shopping-cart font-22 avatar-title text-white"></i>
                        </div>
                     </div>
                     <div class="col-8">
                        <div class="text-right">
                           <h3 class="text-dark mt-1"><span>{{@$sellerProducts}}</span></h3>
                           <p class="text-muted mb-1 text-truncate">Products </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-xl-3">
               <div class="widget-rounded-circle card-box">
                  <div class="row">
                     <div class="col-4">
                        <div class="avatar-lg rounded-circle bg-primary border-primary border">
                        <i class="fa fa-truck font-22 avatar-title text-white"></i>
                        </div>
                     </div>
                     <div class="col-8">
                        <div class="text-right">
                           <h3 class="text-dark mt-1"><span>{{@$orders}}</span></h3>
                           <p class="text-muted mb-1 text-truncate">Orders</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end icon problem -->

         <div class="row">
            <div class="col-md-12">
               <div class="card-box">
                  <h4 class="header-title mb-3">Recent Users</h4>
                  <div class="table-responsive">
                     <table class="table table-borderless table-hover table-nowrap table-centered m-0 dash">
                        <thead class="thead-light">
                           <tr>
                              <th>Sr. No</th>
                              <th>Phone Number</th>
                              <th>Date</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usersPagination as $key => $user): ?>
                                
                               <tr>
                                  <td> {{$key+1}} </td>
                                  <td> +{{$user['isd_code']}}- {{$user['mobile_number']}} </td>
                                  <td> {{$user['created_at']}} </td>
                               </tr>
                            <?php endforeach ?>

                        </tbody>
                     </table>
                 
                     <div class="justify-content-end d-flex">
                        <nav class="mt-2">
                          <!-- <ul class="pagination">
                            <div class="centred">
                                {{$usersPagination->links("pagination::bootstrap-4")}}
                            </div>
                          </ul> -->
                          <a href="{{url('/admin/userManagement/user/list')}}" class="seeMore">See More</a>
                        </nav>
                     </div>

                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
               <div class="card-box">
                  <h4 class="header-title mb-3">Recent Shops</h4>
                  <div class="table-responsive">
                     <table class="table table-borderless table-hover table-nowrap table-centered m-0 dash">
                        <thead class="thead-light">
                           <tr>
                              <th>Sr. No</th>
                              <th>Business Name</th>
                              <th>Business Category</th>
                              <th>Phone Number</th>
                              <th>Created on</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sellerPagination as $key => $seller): ?>
                                <?php
                                    $buisnessCategories = DB::table('buisness_categories')
                                                                    ->where('id',$seller['buisness_category_id'])
                                                                    ->first();                                
                                ?>
                           <tr>
                              <td> {{$key+1}} </td>
                              <td> {{@$seller['buisness_name']}} </td>
                              <td> {{@$buisnessCategories->name}} </td>
                              <td> {{@$seller['mobile_number']}} </td>
                              <td> {{@$seller['created_at']}} </td>
                           </tr>
                            <?php endforeach ?>
                        </tbody>
                     </table>
                     <div class="justify-content-end d-flex">
                        <nav class="mt-2">
                          <ul class="pagination">
                          <!--   
                            <div class="centred">
                                {{$sellerPagination->links("pagination::bootstrap-4")}}
                            </div> -->
                             <a href="{{url('/admin/sellerManagement/seller/list')}}" class="seeMore">See More</a>
                          </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


<!-- Footer -->
@include('backend.common.footer')
