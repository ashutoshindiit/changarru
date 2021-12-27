

    @if(isset($sellerProducts))

    <?php foreach ($sellerProducts as $key => $value): ?>

    <div @if($selectedStorageView=="Grid") class="col-lg-4 col-md-4 col-sm-6 col-6" @else class="col-6 col-12" @endif>

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
                    <img src="{{ $product_image }}" alt="">
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
                 
                <!-- @if($value['discounted_price']!=null && $value['price']!=null)

                @php

                    $result = $value['price'] -$value['discounted_price']; 

                    $percentPrice = $result/$value['price']*100;

                @endphp

                <div class="label_product">

                    <span class="label_new"> {{number_format($percentPrice)}} % OFF </span>

                </div>

                @endif -->

                <div class="action_links">

                    @if($value['quantity']!=0)

                    <ul>

           <!--              <li class="add_to_cart"><a  class="productCart" userId="{{$value['id']}}" product="{{$value['id']}}" data-tippy="Add to cart" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a></li> -->

                    </ul>

                    @else

                    <ul>

                        <!-- <li class="add_to_cart"><a data-tippy="out of stocks" data-tippy-placement="top" data-tippy-arrow="true" data-tippy-inertia="true"> <span class="lnr lnr-cart"></span></a></li> -->

                    </ul>

                    @endif

                </div>

            </div>

            <div class="product_content grid_content">
                <h4 class="product_name"><a href="{{url($slug.'/product-details/'.$value['product_slug'])}}">{{$value['name']}}</a></h4>
                <p><a href="#">{{@$value['sellerCategory']['name']}}</a></p>
                <div class="price_box"> 
                    <!-- //new code start   -->
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
                    <!-- //end code -->

                    <!-- @if($value['quantity']!=0)
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
                    @endif -->
                </div>
                @if($value['quantity']!=0)
                    <div class="cart_button text-center addMobHide">
                        <!-- <a class="mt-2 productCart" product="{{$value['id']}}" href="#"> Add To Cart </a> -->
                    </div>
                @else

                @endif   
            </div>

            <div class="product_content list_content">

                <h4 class="product_name"><a href="{{url($slug.'/product-details/'.$value['product_slug'])}}">{{$value['name']}}</a></h4>

                <p><a href="#">{{@$value['sellerCategory']['name']}}</a></p>

                <div class="price_box"> 
                    <!-- //new code start   -->
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
                    <!-- //end code -->


<!-- 
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

                    @endif -->

                </div>

                <div class="product_desc">

                    <?php 
                        $contentDescription = substr(strip_tags($value['description']),0,210) . "...";
                    ?>

                    <p>{!! $contentDescription !!}</p>

                </div>

                @if($value['quantity']!=0)

                <div class="action_links list_action_right">

                    <ul>

                        <!-- <li class="add_to_cart"><a class="productCart" product="{{$value['id']}}" title="Add to cart">Add to Cart</a></li> -->

                    </ul>

                </div>

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

  





    @else

    <div class="text-center">

        <h3>No Record Found</h3>

    </div>

    <br>

    @endif





