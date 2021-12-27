@include('frontend.common.header')

<style>
        .Site {
  display: flex;
  min-height: 100vh;
  flex-direction: column;
}

.Site-content {
  flex: 1;
}
</style>

<!--shopping cart area start -->

<div class="shopping_cart_area viewCart mt-70 Site-content">
   <div class="container">
    @if(isset($sellerProduct))
        @if(count($sellerProduct)!=0)
        <form action="#">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="cart_page table-responsive sibling">
                            <form id="cart_detail">
                                @csrf                        
                                <table>
                                    <thead>
                                       <tr>
                                          <th class="product_remove">Delete</th>
                                          <th class="product_thumb">Image</th>
                                          <th class="product_name">Product</th>
                                          <th class="product-price">Price</th>
                                          <th class="product_quantity">Quantity</th>
                                          <th class="product_total">Total</th>
                                       </tr>
                                    </thead>

                                    <tbody class="body-cart-detail">
                                        <?php foreach ($sellerProduct as $key => $value): ?>
                                            <?php
                                                if (Auth::check()) {
                                                    $userId  = Auth::user()->id;
                                                } else{
                                                   $userId   = @$_COOKIE['guestId'];
                                                }
                                                $productCartCount = \App\Models\ProductCart::where('product_id',$value['id'])->where('user_id',$userId)->first();
                                            ?>
                                        <tr>
                                            <td class="product_remove"><a href="{{url('/'.$slug.'/'.'delete-cart-product'.'/'.$value['id'])}}"><i class="fa fa-trash-o"></i></a></td>

                                            <td class="product_thumb"><a href="#"><img src="{{@$value['Product']['sellerProductImages'][0]['image']?asset('frontend/assets/img/product/'.@$value['Product']['sellerProductImages'][0]['image']):asset('frontend/images/default.jpg')}}" alt=""></a></td>

                                            <td class="product_name"><a href="#">{{$value['Product']['name']}}</a></td>

                                            <td class="product-price ">$ {{$value['product_quantity_price']}}</td>

                                            <td class="product_quantity"><label>Quantity</label> 
                                                <input pattern="[0-9]*" type="number" min="1"   max="{{$value['quantity']}}"  key="{{$key}}" productId="{{$value['product_id']}}" value="{{isset($value['product_quantity']) ? $value['product_quantity']:1}}" class="product_quantity_update quantityAddToCart" ></td>

                                            <td class="product_total">$ {{$value['total_price']}}</td>
                                        </tr>

                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="cart_submit">
                           <button type="button" id="update-cart-detail">update cart</button>
                        </div>
                    </div>
                </div>
            </div>
         <!--coupon code area start-->

        <div class="coupon_area">

            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <form id="couponForm">

                        <div class="coupon_code left">

                            <h3>Coupon</h3>

                            <div class="coupon_inner">

                               <p>Enter your coupon code if you have one.</p>

                               <input required="" placeholder="Coupon code" id="coupon_name_id" name="coupon_name" value="" type="text">

                               <button id="coupon_form_submit" type="button">Apply coupon</button>

                            </div>

                        </div>

                    </form>

                </div>

               <div class="col-lg-6 col-md-6">

                    <div class="coupon_code right cartDetailRenderData">

                        @include('frontend.element.cartDetail')

                    </div>

               </div>

            </div>

         </div>

         <!--coupon code area end-->

      </form>
          @else
            <button class="btn btn-info"><a href="{{url('/'.$slug)}}">Go to store</a></button>
          <div class="text-center mt-4">
                <h3>No product in cart</h3>    
          </div>
          @endif
      @endif

   </div>
</div>



<!--shopping cart area end -->

@include('frontend.common.footer')

<script type="text/javascript">

    var auth = "{{Auth::check()}}";
    var slug        = $(this).attr('slug');
    $(document).ready(function(){ 
        $( "#update-cart-detail" ).click(function() {
            var myarray = {};
            $(".product_quantity_update").each(function(key,val) {
                var quantity  = $(this).val()
                console.log($(this).attr('productid'));
                myarray[$(this).attr('productid')] = $(this).val();
            }); 

            if(auth==1){
               $.ajax({
                    url: "{{ url('/') }}"+'/'+slug+'/update-cart-detail' ,
                    type:'post',
                    data:{myarray:JSON.stringify(myarray),_token:"{{ csrf_token() }}" },
                    success:function(response){
                       if(response['status']=="true") { 
                            $('#userId').val(response['userId'])
                            console.log(response);  
                            toastr.success(response.msg);
                               location.reload();
                       }else{
                           console.log(response);
                           toastr.error('Something went wrong');
                       }
                    }
               })
            }else{
                toastr.error('please login to update cart');
            }
       });
   })

</script>