@include('frontend.common.header')
<!--product details start-->

<div class="product_details mt-70 mb-70">

   <div class="container">

      <div class="row">

         <div class="col-lg-6 col-md-6">

            <div class="product-details-tab position-relative">
                @if(isset($sellerProducts['sellerProductSizes'][0]))
               
                    @if($sellerProducts['sellerProductSizes'][0]['discount_price']!=null && $sellerProducts['sellerProductSizes'][0]['size_price']!=null)

                       @php
                           $result = $sellerProducts['sellerProductSizes'][0]['size_price'] - $sellerProducts['sellerProductSizes'][0]['discount_price']; 

                           $percentPrice = $result/$sellerProducts['sellerProductSizes'][0]['size_price']*100;
                       @endphp
                        <span class="newoff">{{number_format($percentPrice)}} % OFF</span>
                    @endif
                @else
                    @if($sellerProducts['discounted_price']!=null && $sellerProducts['price']!=null)
                        @php
                            $result = $sellerProducts['price'] -$sellerProducts['discounted_price']; 
                            $percentPrice = $result/$sellerProducts['price']*100;
                        @endphp
                        <span class="newoff">{{number_format($percentPrice)}} % OFF</span>
                    @endif
                @endif
                    
               <div id="img-1" class="zoomWrapper single-zoom">
                    <a href="#"><img id="zoom1" src="{{@$sellerProducts['sellerProductImages'][0]['image']?asset('frontend/assets/img/product/'.$sellerProducts['sellerProductImages'][0]['image']):asset('public/backend/assets/images/default.jpg')}}" data-zoom-image="{{asset('frontend/assets/img/product/'.@$sellerProducts['sellerProductImages'][0]['image'])}}" alt="big-1"></a>
               </div>

               <div class="single-zoom-thumb">
                  <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                    <?php foreach ($sellerProducts['sellerProductImages'] as $key => $productImage): ?>

                         <li>
                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset('frontend/assets/img/product/'.$productImage['image'])}}" data-zoom-image="{{asset('frontend/assets/img/product/'.$productImage['image'])}}">
                                <img src="{{asset('frontend/assets/img/product/'.$productImage['image'])}}" alt="zo-th-1"/>
                            </a>
                         </li>
                    <?php endforeach ?> 
                  </ul>
               </div>
            </div>
         </div>

         <div class="col-lg-6 col-md-6">
            <div class="product_d_right">
               <form action="#">
                    <h1><a>{{$sellerProducts['name']}}</a></h1>
                    <div class="price_box"> 

                        @if(isset($sellerProducts['sellerProductSizes'][0]))    

                            @if($sellerProducts['sellerProductSizes'][0]['discount_price']!=null && $sellerProducts['sellerProductSizes'][0]['size_price']!=null)
                                <span class="current_price">${{$sellerProducts['sellerProductSizes'][0]['discount_price']}}</span>
                                <span class="old_price">${{$sellerProducts['sellerProductSizes'][0]['size_price']}}</span>
                            @elseif($sellerProducts['sellerProductSizes'][0]['discount_price']==null)
                                <span class="current_price">${{$sellerProducts['sellerProductSizes'][0]['size_price']}}</span>
                            @elseif($sellerProducts['sellerProductSizes'][0]['size_price']==null)
                                <span class="current_price">${{$sellerProducts['sellerProductSizes'][0]['discount_price']}}</span>
                            @endif
                        @else
                            @if($sellerProducts['discounted_price']!=null && $sellerProducts['price']!=null)
                                <span class="current_price">${{$sellerProducts['discounted_price']}}</span>
                                <span class="old_price">${{$sellerProducts['price']}}</span>
                            @elseif($sellerProducts['discounted_price']==null)
                                <span class="current_price">${{$sellerProducts['price']}}</span>
                            @elseif($sellerProducts['price']==null)
                                <span class="current_price">${{$sellerProducts['discounted_price']}}</span>
                            @endif
                        @endif
                    </div>

                    <div class="product_desc">
                        <?php 
                            $contentDescription = substr(strip_tags($sellerProducts['description']),0,210) . "...";
                            if (Auth::check()) {
                                $userId  = Auth::user()->id;
                            } else{
                               $userId   = @$_COOKIE['guestId'];
                            }

                            $productCartCount = \App\Models\ProductCart::where('product_id',$sellerProducts['id'])
                                                                        ->where('user_id',$userId)
                                                                        ->first();
                        ?>
                        <p>{{strip_tags($contentDescription) }} </p>
                    </div>
                    <br>


                    <br>

                    @if(isset($sellerProducts['sellerProductSizes']))
                        @if(count($sellerProducts['sellerProductSizes'])>0)
                        <div class="form-group text-left">
                            <label class="bold_text build_label">Choose Size</label>
                            <div class="wrap_rad_chk1">
                                <div class="row ">
                                            <?php  
                                                // dd($sellerProducts['sellerProductSizes']); 
                                            ?>
                                    @foreach($sellerProducts['sellerProductSizes'] as $key => $value)                  
                                        <?php

                                            $userProductCartData = \App\Models\ProductCart::where('product_id',$sellerProducts['id'])->where('user_id',$userId)->where('size_id',$value['id'])->first();
                                            
                                            if($value['discount_price'] != null && $value['size_price']!=null){
                                               $finalSizePrice      = $value['discount_price'];
                                               $old_discountPrice   = $value['size_price'];
                                            }elseif($value['discount_price'] == null){
                                               $finalSizePrice      = $value['size_price'];
                                               $old_discountPrice = null;
                                            }elseif($value['size_price'] == null){
                                               $finalSizePrice = $value['discount_price'];
                                               $old_discountPrice = null;
                                            }
                                            // dd($finalSizePrice,$old_discountPrice); 
                                        ?>

                                        <div class="col-sm-4">
                                            <div class="custom-control custom-radio ">
                                                 <input type="radio" @if($key==0) checked @endif class="custom-control-input product_size" id="pe{{$value['id']}}" @if(isset($userProductCartData['product_quantity'])) usedSizeQunatity = "{{@$userProductCartData['product_quantity']}}"  @else usedSizeQunatity="" @endif  prize="{{@$finalSizePrice}}" oldRejectedPrize="{{@$old_discountPrice}}" quantity="{{$value['quantity']}}" sizeId = "{{$value['id']}}" name="size" value="{{$value['id']}}">
                                                 <label class="custom-control-label" for="pe{{$value['id']}}">{{$value['size']}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <label id="user_property_id-error" class="error" for="user_property_id"></label>
                            </div>
                        </div>
                        @endif
                    @endif

<!-- 
                    @if(isset($sellerProducts))
                        @if(count($sellerProducts['sellerProductColors'])>0)
                        <div class="form-group text-left">
                            <label class="bold_text build_label">Choose Color</label>
                            <div class="wrap_rad_chk1">
                                <div class="row ">
                                    @foreach($sellerProducts['sellerProductColors'] as $key => $val)   -->                
                                        <?php
                                            // $userProductCartData = \App\Models\ProductCart::where('product_id',$sellerProducts['id'])->where('user_id',$userId)->where('color_id',$val['id'])->first();
                                        ?>
                                        <!-- <div class="col-sm-4">
                                            <div class="custom-control custom-radio ">
                                                 <input type="radio" @if($key==0) checked @endif class="custom-control-input product_color" id="ke{{$val['id']}}"  name="color" colorId ="{{$val['id']}}" value="{{$val['id']}}">
                                                 <label class="custom-control-label" for="ke{{$val['id']}}">{{$val['name']}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif -->


                        @if(isset($sellerProducts['sellerProductSizes']['quantity']))    
                            @if($sellerProducts['sellerProductSizes']['quantity']!=0)
                                
                                <?php 
                                    $usedProductQuan = ProductCart::where('user_id',$userId)
                                                                    ->where('product_id',$sellerProducts['id'])
                                                                    ->where('size_id',$sellerProducts['id'])
                                                                    ->pluck('product_quantity')
                                                                    ->first();
                                    $usedProductQuan = ($usedProductQuan) ? $usedProductQuan : 0;  
                                    $maxQuan = $sellerProducts['sellerProductSizes']['quantity'] - $usedProductQuan;
                                    // dd($maxQuan);
                                ?>


                               <div class="product_variant quantity">
                                    <label>quantity</label>
                                    <input min="{{ ( $maxQuan < 1) ? 0 : 1 }}" max="{{ $maxQuan }}" id="quantityAddToCart" class="quantityAddToCart" value="{{ ( $maxQuan < 1) ? 0 : 1 }}" type="number">
                                    @if($maxQuan > 0 )
                                    <button class="button addProductCartDetail" userId ="{{$userId}}" product ="{{$sellerProducts['id']}}" slug={{$slug}} type="button">add to cart</button>  
                                    @else
                                    <button class="button" userId ="{{$userId}}" product ="{{$sellerProducts['id']}}" slug={{$slug}} type="button" disabled>add to cart</button>  
                                    @endif
                                    <button class="button" type="submit">Buy Now</button>  
                                </div>

                            @else
                            out of stock
                            @endif

                           
                        @else
                            @if($sellerProducts['quantity']!=0)
                               <div class="product_variant quantity">
                                    <input type="hidden" name="product_size_id" class="product_size" value="">
                                    @php 
                                        $maxQuan = $sellerProducts['quantity'] - $usedProductQuan;
                                    @endphp
                                    @if($maxQuan==0)
                                    @else
                                        <label>quantity</label>
                                        <input min="{{ ( $maxQuan < 1) ? 0 : 1 }}" max="{{ $maxQuan }}" id="quantityAddToCart" class="quantityAddToCart" value="{{ ( $maxQuan < 1) ? 0 : 1 }}" type="number">
                                    @endif
                                    @if($maxQuan > 0 )
                                        <button class="button addProductCartDetail" userId ="{{$userId}}" product ="{{$sellerProducts['id']}}" slug={{$slug}} type="button">add to cart</button>  
                                    @else
                                    <!-- <button class="button" userId ="{{$userId}}" product ="{{$sellerProducts['id']}}" slug={{$slug}} type="button" disabled>add to cart</button> -->
                                    <h3>out of stock</h3>  
                                    @endif
                                    <!-- <button class="button" type="submit">Buy Now</button>   -->
                                </div>

                            @else
                            out of stock
                            @endif
                        @endif
    
               </form>

            </div>

         </div>

      </div>

   </div>

</div>

<!--product details end-->

<!--product info start-->

<div class="product_d_info mb-65">

   <div class="container">

      <div class="row">

         <div class="col-12">

            <div class="product_d_inner">

               <div class="product_info_button">

                  <ul class="nav" role="tablist" id="nav-tab">

                     <li >

                        <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Description</a>

                     </li>

                  </ul>

               </div>

               <div class="tab-content">

                  <div class="tab-pane fade show active" id="info" role="tabpanel" >

                     <div class="product_info_content">

                       {!!$sellerProducts['description']!!}

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

   </div>

</div>

<!--product info end-->



<!--product area start-->

@if(isset($otherSellerProducts))

    <section class="product_area related_products">

        <div class="container">

            <div class="row">

                <div class="col-12">

                    <div class="section_title">

                        <h2>Related Products	</h2>

                    </div>

                </div>

            </div> 

            <div class="row">

                <div class="col-12">

                    @if(count($otherSellerProducts)>0)
                    <div class="product_carousel product_column5 owl-carousel">
                        <?php foreach ($otherSellerProducts as $key => $value): ?>

                            <article class="single_product">

                                <figure>

                                    <div class="product_thumb">

                                        <a class="primary_img" href="{{url('/'.$slug.'/product-details/'.$value['product_slug'])}}"><img src="{{@$value['sellerProductImages'][0]['image']?asset('frontend/assets/img/product/'.$value['sellerProductImages'][0]['image']):asset('public/backend/assets/images/default.jpg')}}" alt=""></a>



                                        <a class="secondary_img" href="{{url('/'.$slug.'/product-details/'.$value['product_slug'])}}"><img src="{{@$value['sellerProductImages'][0]['image']?asset('frontend/assets/img/product/'.$value['sellerProductImages'][0]['image']):asset('public/backend/assets/images/default.jpg')}}" alt=""></a>



                                        <div class="label_product">

                                            @if($value['discounted_price']!=null && $value['price']!=null)

                                                @php

                                                    $result = $value['price'] -$value['discounted_price']; 

                                                    $percentPrice = $result/$value['price']*100;

                                                @endphp
                                                 <span class="newoff">{{number_format($percentPrice)}} % OFF</span>
                                            @endif    
                                            <!-- <span class="label_new">40% OFF</span> -->
                                        </div>

                                       <!--  <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a href="cart.php" data-tippy="Add to cart" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a></li>

                                            </ul>
                                        </div> -->


                                    <figcaption class="product_content">

                                        <h4 class="product_name"><a href="{{url('/'.$slug.'/product-details/'.$value['product_slug'])}}">{{$value['name']}}</a></h4>

                                        <p><a href="{{url('/'.$slug.'/product-details/'.$value['product_slug'])}}">{{$value['sellerCategory']['name']}}</a></p>

                                        <div class="price_box"> 

                                           @if($value['discounted_price']!=null && $value['price']!=null)

                                               <span class="current_price">${{$value['discounted_price']}}</span>

                                               <span class="old_price">${{$value['price']}}</span>

                                           @elseif($value['discounted_price']==null)

                                               <span class="current_price">${{$value['price']}}</span>

                                           @elseif($value['price']==null)

                                               <span class="current_price">${{$value['discounted_price']}}</span>

                                           @endif

                                       </div>

                                    </figcaption>

                                </figure>

                            </article>

                        <?php endforeach ?> 
                    </div>
                    @else
                    <div class="text-center">
                        <h5>No relevant products yet</h5>
                    </div>
                    @endif

                </div>

            </div>  

        </div>

    </section>

@endif

    <!--product area end-->

@include('frontend.common.footer')

