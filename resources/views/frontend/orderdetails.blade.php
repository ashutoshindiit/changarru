@include('frontend.common.header')

<style>
   .shareBox a{
        font-size: 23px;
     }
    
   .shareBox i
    {
        margin-right: 10px;
    }
</style>

<div class="orderDetailsBox sidebarOrder">
   <a href="{{url('/'.$slug.'/my-orders')}}" class="arrowBack"><i class="lnr lnr-arrow-left"></i> Order #{{$myOrder['id']}} </a>
   <div class="borderBox">

      <div class="d-flex align-items-center justify-content-between">
         <div class="business-name-with-log-wrap">
            <a class="d-flex align-items-center hover-cls" href="#">
               <img class="" loading="lazy" src="https://api.mydukaan.io/static/images/store-def.jpg" alt="">
               <div>

                  <span class="anchor-1 order-store-name-txt">{{@$myOrder['seller']['buisness_name']}}</span>
                  <span class="timeBlock"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($myOrder['created_at']))->toDayDateTimeString() ?> | 1 Item | ${{$myOrder['grand_total']}}</span>
               </div>
            </a>
         </div>

         <?php 
              // $seller = App\Models\Seller::where('id',$sellerProducts['seller_id'])
                                          // ->first();
              $current_url = Request::FullUrl();
              if($myOrder['seller']['mobile_number']){
                   $phone = '+'.$myOrder['seller']['isd_code'].$myOrder['seller']['mobile_number'];
               }else{
                   $phone = '+918054530498';
               }
              // dd($phone);
          ?>

          <div class="booking_detail_button wdt-30 shareBox">
              <a href="tel:{{$phone}}" style="color:#f7be16"><i class="fa fa-phone ml-4" aria-hidden="true"></i></a>
              <a href="https://api.whatsapp.com/send?phone={{$phone}}&text=Hi" style="color:#25D366" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
          </div>

      </div>
      <div class="order-info-section mt-3">
         <div class="order-products">
            <div class="order-products-count-txt">Order Status</div>
            <div class="order-product-info">
               <div class="order-tracking">
                  <span class="is-complete"></span>
                  <p>Order</p>
               </div>
               <div class="order-tracking @if($myOrder['status']=='1')completed @endif">
                  <span class="is-complete"></span>
                  <p>Pending</p>
               </div>
               <div class="order-tracking @if($myOrder['status']=='2')completed @endif">
                  <span class="is-complete"></span>
                  <p>Accepted</p>
               </div>
               <div class="order-tracking @if($myOrder['status']=='3')completed @endif">
                  <span class="is-complete"></span>
                  <p>Cancelled</p>
               </div>
               <div class="order-tracking @if($myOrder['status']=='4')completed @endif">
                  <span class="is-complete"></span>
                  <p>Shipped</p>
               </div>
               <div class="order-tracking @if($myOrder['status']=='5')completed @endif">
                  <span class="is-complete"></span>
                  <p>Delivered</p>
               </div>
            </div>
         </div>
        

         <div class="order-products brtop0">
            <div class="order-products-count-txt">{{$myOrder['order_details_count']}} item</div>
            <div class="order-product-info">
               
            <?php foreach ($sellerProduct as $key=>$value): ?>
                <?php   
                    $sellerProductColorRecord = \App\Models\SellerProductColor::where('id',$value['color_id'])->first();
                    $sellerProductSizeRecord  = \App\Models\SellerProductSize::where('id',$value['size_id'])->first();

                    $sellerProduct = \App\Models\sellerProduct::with('sellerUnit','sellerCategory','sellerProductColors','sellerProductSizes','sellerProductImages')->where('id',$value['product_id'])->first();
                    
                    $grandPriceOrder = $value['product_quantity']* $value['product_quantity_price'];
                ?>
               <div class="prod-item-container">
                  <span class=""><img class="" loading="lazy" src="{{asset('frontend/assets/img/product/'.@$value['orderProduct']['sellerProductImages'][0]['image'])}}" alt="Dell Laptop"></span>
                  <div class="order-item-info">
                     <div class="order-item-name text-capitalize">
                        <span class="name-hover-cls c-black-1 text-capitalize">{{$value['orderProduct']['name']}}</span>
                        <div></div>
                     </div>
                     <p class="prod-unit-txt">per piece</p>
                     <div class="order-item-qty-cost">
                        <span><span class="mr6 qty-box"><span>{{$value['product_quantity']}}</span></span>x ${{$value['product_quantity_price']}}</span>  &nbsp  &nbsp
                        <div class="text-2">${{$grandPriceOrder}}</div>
                     </div>

                     @if(isset($sellerProductSizeRecord['size']))
                     <p class="prod-unit-txt">Size:{{@$sellerProductSizeRecord['size']}}</p>
                     @endif

                     @if(isset($sellerProductColorRecord['name'])) 
                     <p class="prod-unit-txt">Color: {{@$sellerProductColorRecord['name']}}</p>
                     @endif

                  </div>
               </div>
            </div>

         </div>
        <?php endforeach ?>

         <div class="order-products brtop0">
            <div class="order-total">
               <div><span>Item Total</span><span>${{$myOrder['total_price']}}</span></div>
               <div><span><span class="mr8">Delivery</span></span><span><span class="c-green-1">Free</span></span></div>
               <?php 
                    $sellerExtraCharge = \App\Models\SellerExtraCharge::where('seller_id',1)
                                                                        ->get();
               ?>

               <?php
                       $sellerCharge = \App\Models\SellerCharge::where('seller_id',$sellerProduct['seller_id'])->where('gst','active')
                                   ->first();

                       $new_grand_value = ($sellerCharge['gst_percentage'] / 100) * $myOrder['total_price'];
               
                       $newGrandAmount = $myOrder['total_price'] + $new_grand_value;
                       // grandFinalAmount
                       $sellerExtraCharge = \App\Models\SellerExtraCharge::where('seller_id',1)->get();
                       // dd($sellerProduct,$sellerCharge,$new_grand_value,$newGrandAmount,$sellerExtraCharge);
               ?>

               @if(isset($sellerCharge['gst']))
                   @if($sellerCharge['gst']=='active')

                   <div><span>GST ({{$sellerCharge['gst_percentage']}}%)</span><span>${{$myOrder['tax']}}</span></div>
                   @endif
               @endif



               @if(isset($sellerExtraCharge))
                   <?php foreach ($sellerExtraCharge as $key => $val): ?>
                      <div><span>{{$val['charge_name']}} @if($val['charges_in_percent']) ({{ $val['charges_in_percent']}}%) @endif</span>     
                       <?php 
                           if($val['charges_in_percent']){
                              $extraCharges = ($val['charges_in_percent'] / 100) * $myOrder['total_price']; 
                           }else{
                              $extraCharges = $val['charges_in_flat_price'];
                           }
                       ?>
                       <span>$ {{$extraCharges}}</span></div>
                       
                  
                   <?php endforeach ?>
               @endif

               <!-- <div><spasn><span class="mr8">Tax</span></span><span><span class="c-green-1">${{$myOrder['tax']}}</span></span></div> -->

               <div class="grand-total-row"><span><span class="mr8">Grand Total</span></span><span>${{$myOrder['grand_total']}}</span></div>
            </div>
         </div>

         <?php 
            // dd($myOrder);
         ?>
         <div class="order-products brtop0 brbot0">
            <div class="customer-details">
               <h4 class="customer-details-header">YOUR DETAILS</h4>
               <table>
                  <tbody>
                     <tr>
                        <td>Name:</td>
                        <td>{{$myOrder['orderAddress']['name']}}</td>
                     </tr>
                     <tr>
                        <td>Mobile:</td>
                        <td>+{{$myOrder['orderAddress']['isd_code']}}-{{@$myOrder['orderAddress']['mobile_number']}}</td>
                     </tr>
                     <tr>
                        <td>Address:</td>
                        <td>{{$myOrder['orderAddress']['address']}}</td>
                     </tr>
                     <tr>
                        <td>City:</td>
                        <td>{{$myOrder['orderAddress']['city']}}</td>
                     </tr>
                     <tr>
                        <td>Pin Code:</td>
                        <td>{{$myOrder['orderAddress']['pincode']}}</td>
                     </tr>
                     <tr>
                        <td>Payment: </td>
                        <td>Cash on Delivery</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

@include('frontend.common.footer')
