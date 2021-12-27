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
                        <li class="breadcrumb-item"><a href="{{url('admin/orderManagement/order/order-list')}}">View Order</a></li>
                     </ol>
                  </div>
                  <h4 class="page-title">View Order</h4>
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
                              <h4 class="header-title mb-3 pull-left">Order Information</h4> 
                              <a href="{{url('admin/orderManagement/order/order-list')}}" class="btn btn-primary pull-right  mb-3">Back To Orders</a>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-8 offset-2">
                           <div class="profileinfoms usertab mb-3">
                              <h3>Order information</h3>
                              <table class="table">
                                 <tbody>
                                    <tr>
                                       <th scope="row" style="min-width: 250px" class="bgthecolor">Order ID</th>
                                       <td>{{@$myOrder['id']}}</td>
                                    </tr>
                                    <tr>
                                       <th scope="row" style="min-width: 250px" class="bgthecolor">Seller</th>
                                       <td>{{@$myOrder['seller']['buisness_name']}}</td>
                                    </tr>
                                    <tr>
                                       <th scope="row" style="min-width: 250px" class="bgthecolor">Buyer</th>
                                       <td>{{@$myOrder['user']['mobile_number']}}</td>
                                    </tr>
                                    <tr>
                                       <th scope="row" style="min-width: 250px" class="bgthecolor">Amount</th>
                                       <td>${{@$myOrder['grand_total']}}</td>
                                    </tr>
                                    <tr>
                                       <th scope="row" style="min-width: 250px" class="bgthecolor">Order Status</th>
                                       <td><span @if($myOrder['orderStatus']['order_status']=='Delivered') class="badge badge-success" @else class="badge badge-danger" @endif>{{$myOrder['orderStatus']['order_status']}}</span></td>
                                    </tr>
                                    
                                    <tr>
                                       <th scope="row" style="min-width: 250px" class="bgthecolor">Address</th>
                                       <td>{{$myOrder['orderAddress']['name']}} + {{$myOrder['orderAddress']['isd_code']}} - {{$myOrder['orderAddress']['mobile_number']}} <br> {{$myOrder['orderAddress']['city']}},{{$myOrder['orderAddress']['address']}},{{$myOrder['orderAddress']['pincode']}} <br> Cash on Delivery </td>
                                    </tr>
                                    
                                    <tr>
                                       <th scope="row" style="min-width: 250px" class="bgthecolor"> ITEM</th>
                                       <td>
                                          <div class="row">
                                             <?php foreach ($sellerProduct as $key => $val): ?>
                                                <?php 
                                                    $ordersDetail = \App\Models\ordersDetail::with('seller','seller.sellerProduct')
                                                                                ->where('order_id',$orderId)
                                                                                ->where('product_id',$val['id'])
                                                                                ->first();

                                                    $sellerProduct = \App\Models\sellerProduct::with('sellerUnit','sellerCategory','sellerProductColors','sellerProductSizes','sellerProductImages')
                                                                    ->where('id',$val['id'])->first();
                                                    
                                                    $grandPriceOrder = $ordersDetail['product_quantity']* $ordersDetail['product_quantity_price'];
                                                ?>                                             
                                                 <div class="col-md-4 text-center">
                                                    <img class="userimg" src="{{asset('frontend/assets/img/product/'.@$sellerProduct['sellerProductImages'][0]['image'])}}" alt=""> 
                                                    <div> {{$val['name']}} </div> 
                                                    <div> ${{$grandPriceOrder}}  </div>
                                                 </div>
                                             <?php endforeach ?>

                                          </div>
                                       </td>
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
