
@include('frontend.common.header')



<style>

    #preloader {
      width: 100%;
      height: 100%;
      position: fixed;
      z-index: 9999;
      background-color: #fff;
    }


    #loader {
        border: 10px solid rgba(217, 217, 217, 0.1);
      border-radius: 50%;
      border-top: 10px solid #9DB704;
      width: 120px;
      height: 120px;
      position: absolute;
      left: 50%;
      right: 0;
      top: 50%;
      margin-left: -60px;
      margin-top: -60px;
      bottom: 0;
      -webkit-animation: spin 2s linear infinite;
      -o-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }

   @media (max-width: 767px)
   {
      .showOnIndex
      {
         display: block;
      }
   }
</style>


<!--shop  area start-->

<div class="shop_area shop_reverse mt-70 mb-70 ">

   <div class="container">

      <div class="row">

         <div class="col-lg-3 col-md-12">

         @include('frontend.common.sidebar')

            <!--sidebar widget start-->

            <!--sidebar widget end-->

         </div>
             <div id="preloader">
                <div id="loader"></div>
             </div>
         <div class="col-lg-9 col-md-12">

            <!--shop wrapper start-->

            <!--shop toolbar start-->

            <div class="shop_toolbar_wrapper">

               <div class="shop_toolbar_btn">

                  <button data-role="grid_3" type="button" class=" btn-grid-3 active productDisplayView" data-toggle="tooltip" title="Grid"></button>

                  <button data-role="grid_list" type="button" class="btn-list productDisplayView" data-toggle="tooltip" title="List"></button>

               </div>

                <div class="page_amount dataHtmlCount_class">

                  <p>Showing  {{$sellerProducts->currentPage()}} –  {{$sellerProducts->count()}} of {{ $sellerProducts->count() }} results</p>

               </div>

            </div>

            <!--shop toolbar end-->
             @if(isset($sellerProducts))
            <div class="row shop_wrapper grid_3 category_wise_class">

                <?php foreach ($sellerProducts as $key => $value): ?>
                   <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                        <div class="single_product">
                           <div class="product_thumb">
                               @php 
                               if(isset($value['sellerProductImages'][0]['thumbnail_image']) && $value['sellerProductImages'][0]['thumbnail_image']){
                                    $product_image =url('/storage/app/product-images/'.$value['sellerProductImages'][0]['thumbnail_image']); 
                               }else{
                                    $product_image = asset('public/backend/assets/images/default.jpg');
                               }
                               @endphp 
                                <a class="primary_img" href="{{url($slug.'/product-details/'.@$value['product_slug'])}}">
                                    <img src="{{  $product_image }}" alt="">
                                </a>
                                
                                <a class="secondary_img" href="{{url($slug.'/product-details/'.$value['product_slug'])}}">

                                    <img src="{{ $product_image }}" alt="">
                                </a>

                                @if(isset($value['sellerProductSizes'][0]))

                                    @if($value['sellerProductSizes'][0]['discount_price']!=null && $value['sellerProductSizes'][0]['size_price']!=null)
                                        @php
                                            $result = $value['sellerProductSizes'][0]['size_price'] -$value['sellerProductSizes'][0]['discount_price']; 
                                            $percentPrice = $result/$value['sellerProductSizes'][0]['size_price']*100;
                                        @endphp
                                        <div class="label_product">
                                            <span class="label_new"> {{number_format($percentPrice)}} % OFF </span>
                                        </div>
                                    @endif     
                                @else
                                    @if($value['discounted_price']!=null && $value['price']!=null)
                                        @php
                                            $result = $value['price'] -$value['discounted_price']; 
                                            $percentPrice = $result/$value['price']*100;
                                        @endphp
                                        <div class="label_product">
                                            <span class="label_new"> {{number_format($percentPrice)}} % OFF </span>
                                        </div>
                                    @endif 
                                 @endif

<!--                             <div class="action_links">
                                @if($value['quantity']!=0)
                                    <ul>
                                        <li class="add_to_cart"><a  class="productCart" userId="{{$value['id']}}" product="{{$value['id']}}" data-tippy="Add to cart" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a></li>
                                    </ul>
                                @else
                                    <ul>
                                        <li class="add_to_cart"><a data-tippy="out of stocks" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a></li>
                                    </ul>
                                @endif
                            </div> -->
                        </div>

                        <div class="product_content grid_content">

                            <h4 class="product_name"><a href="{{url($slug.'/product-details/'.$value['product_slug'])}}">{{$value['name']}}</a></h4>

                            <p><a href="#">{{@$value['sellerCategory']['name']}}</a></p>


                            <div class="price_box"> 
                                @if(isset($value['sellerProductSizes'][0]))

                                    @if($value['sellerProductSizes'][0]['discount_price']!=null && $value['sellerProductSizes'][0]['size_price']!=null)
                                       <span class="current_price">${{$value['sellerProductSizes'][0]['discount_price']}}</span>
                                       <span class="old_price">${{$value['sellerProductSizes'][0]['size_price']}}</span>
                                    @elseif($value['sellerProductSizes'][0]['discount_price']==null)
                                       <span class="current_price">${{$value['sellerProductSizes'][0]['size_price']}}</span>
                                    @elseif($value['sellerProductSizes'][0]['size_price']==null)
                                       <span class="current_price">${{$value['sellerProductSizes'][0]['discount_price']}}</span>
                                    @endif

                                @else
                                   
                                    @if($value['quantity']!=0)

                                        @if($value['discounted_price']!=null && $value['price']!=null)

                                            <span class="current_price">${{$value['discounted_price']}}</span>

                                            <span class="old_price">${{$value['price']}}</span>

                                        @elseif($value['discounted_price']==null)

                                            <span class="current_price">${{$value['price']}}</span>

                                        @elseif($value['price']==null)

                                            <span class="current_price">${{$value['discounted_price']}}</span>

                                        @endif

                                    @else

                                    Out Of Stock

                                    @endif

                                @endif        
                            </div>



                             @if($value['quantity']!=0)

                              <!--   <div class="cart_button text-center addMobHide">

                                    <a class="mt-2 productCart" product="{{$value['id']}}" href="#"> Add To Cart </a>

                                </div>
 -->
                             @else



                             @endif   

                        </div>



                        <div class="product_content list_content">

                            <h4 class="product_name"><a href="{{url($slug.'/product-details/'.$value['product_slug'])}}">{{$value['name']}}</a></h4>

                            <p><a href="#">{{@$value['sellerCategory']['name']}}</a></p>

                           <div class="price_box"> 

                                @if($value['quantity']!=0)

                                    @if($value['discounted_price']!=null && $value['price']!=null)

                                        <span class="current_price">${{$value['discounted_price']}}</span>

                                        <span class="old_price">${{$value['price']}}</span>

                                    @elseif($value['discounted_price']==null)

                                        <span class="current_price">${{$value['price']}}</span>

                                    @elseif($value['price']==null)

                                        <span class="current_price">${{$value['discounted_price']}}</span>

                                    @endif

                                @else

                                    Out Of Stock

                                @endif

                            </div>

                            <div class="product_desc">

                                <?php 

                                    $contentDescription = substr(strip_tags($value['description']),0,210) . "...";

                                ?>

                               <p>{!! $contentDescription !!}</p>

                            </div>



                            @if($value['quantity']!=0)

                          <!--   <div class="action_links list_action_right">
                               <ul>
                                  <li class="add_to_cart"><a class="productCart" product="{{$value['id']}}" title="Add to cart">Add to Cart</a></li>
                               </ul>
                            </div> -->

                            @else



                            @endif   

                        </div>

                      </div>

                   </div>

              <?php endforeach ?>



              @if(count($sellerProducts)==0)

                  <div class="text-center">

                      <h3>No Record Found</h3>

                  </div>

              @endif

              

             <div class="pageBox">

                  {{@$sellerProducts->appends(request()->query())->links("pagination::bootstrap-4")}}

              </div>

              @else

             <div class="text-center">

                 <h3>No Record Found</h3>

             </div>

             <br>

              @endif

            </div>

         </div>

      </div>

   </div>

</div>

<!--shop  area end-->

@include('frontend.common.footer')

