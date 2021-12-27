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
                        <li class="breadcrumb-item active">Orders</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Orders</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card-box">
                  <div class="d-flex align-items-center justify-content-between">
                     <h4 class="header-title mb-3 pull-left">Orders List</h4> 
                  </div>
                  <div class="table-responsive">
                     <table class="table table-borderless table-hover table-nowrap table-centered m-0 dash">
                        <thead class="thead-light">
                           <tr>
                              <th>S.no</th>
                              <th>Order Id</th>
                              <th>Seller</th>
                              <th>Buyer(Mobile Number)</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 // dd($_GET['page']);
                                 $count = 1;
                                 if(isset($_GET['page']) && $_GET['page']){
                                    $count = $_GET['page'];
                                 }

                                 $Sno = ($count*10)-10;
                            foreach ($orders as $key => $value): ?>
                           <tr>
                              <td> {{($key+1) + $Sno}} </td>
                              <td> {{@$value['id']}} </td>
                              <td> {{(!empty($value['seller']))? @$value['seller']['buisness_name'] : '-'}} </td>
                              <td> {{(!empty($value['user']['mobile_number']))? @$value['user']['mobile_number'] : '-'}} </td>
                              <td> {{@$value['grand_total']}} </td>
                              <td> <span @if($value['orderStatus']['order_status']=='Delivered') class="badge badge-success" @else class="badge badge-danger" @endif>{{ ucfirst(@$value['orderStatus']['order_status'])}} </span> </td>
                              <td>  
                                 <a href="{{url('admin/orderManagement/order/view-order/'.$value['id'])}}" class="btn btn-xs btn-warning"><i class="mdi mdi-eye"></i></a> 
                              </td>
                           </tr>
                            <?php endforeach ?>
                           
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="centred"> 
                  {{$orders->links("pagination::bootstrap-4")}} 
               </div>

            </div>
         </div>
      </div>
   </div>
 
@include('backend.common.footer')
