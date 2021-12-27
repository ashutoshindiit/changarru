<!--footer area start-->

<footer class="footer_widgets footer_border">

   <div class="footer_bottom">

      <div class="container">

         <div class="row align-items-center">

            <div class="col-lg-6 col-md-6">

               <div class="copyright_area">

                  <p>Copyright © 2021 Changarru. All Rights Reserved.</p>

               </div>

            </div>

            <div class="col-lg-6 col-md-6">

               <div class="footer_payment">

                  <ul>

                     <li><a href="{{url('/'.$slug.'/privacy-policy')}}" class="text-white">Privacy Policy</a></li>

                     <li><a href="{{url('/'.$slug.'/term-and-condtion')}}" class="text-white">Terms & Conditions</a></li>

                  </ul>

               </div>

            </div>

         </div>

      </div>

   </div>

</footer>

<!--footer area end-->

<!-- OTP Screen-->

<div class="modal fade optScreen" id="optScreen" tabindex="-1" role="dialog"  aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">

         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

         <span aria-hidden="true"><i class="icon-x"></i></span>

         </button>

         <div class="modal_body">

            <h1>Mobile Verfication</h1>

            <form id="register_with_login">            

                @csrf

                <div class="contact_message text-center">

                   <div class="inputBox">

                       <span class="prepend-txt"></span>

                       <input type="tel" class="phone" id="mobile_number_optForm" maxlength="10" required="" value="" name="mobile_number" />

                      <input type="hidden" class="form-control" name="isd_code" id="isd_code" value="91">

                   </div>

                   <button type="button" class="mt-4" id="mobile_verification_form_submit"> Send OTP</button>

                </div>

            </form>

         </div>

      </div>

   </div>

</div>

<!-- End Of OTP Screen-->



<!-- OTP Number Screen-->

<div class="modal fade optScreen otpNumber" id="otpNumber" tabindex="-1" role="dialog"  aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">

         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

         <span aria-hidden="true"><i class="icon-x"></i></span>

         </button>

         <div class="modal_body">

            <input type="hidden" id="user_id_otp" name="userId" value="">

            <h1>OTP Verification</h1>

            <form id="otp_form">      

               @csrf      

                <div class="contact_message text-center">

                    <h3 class="optsuc">OTP successfully sent.</h3>

                    <div class="otpnum">
                        <input type="number" name="otp" value="" id="">
                    </div>

                    <input type="hidden" name="WithoutLogin_final_price" id="WithoutLogin_final_price" class="WithoutLogin_final_price" value="">
                    
                    <input type="hidden" name="WithoutLogin_tax" id="WithoutLogin_tax" class="WithoutLogin_tax" value="">
                    
                    <input type="hidden" name="WithoutLogin_grand_total_price" id="WithoutLogin_grand_total_price" class="WithoutLogin_grand_total_price" value="">

                    <button type="button" class="mt-3 cusbtn" id="otp_form_submit" > Go To Order</button> 

                </div>
            </form>

         </div>

      </div>

   </div>

</div>

<!-- End OTP Screen-->



<!-- Add Address Screen-->

<div class="modal fade addresModal" id="addAddress" tabindex="-1" role="dialog"  aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">

         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

         <span aria-hidden="true"><i class="icon-x"></i></span>

         </button>

         <div class="modal_body checkout_form">

            <form id="addFormForAddress" method="post" action="{{url('/'.$slug.'/add-my-addresses')}}">

               @csrf

               <h4>Add new address</h4>

               <div class="row">

                  <div class="col-md-6 mb-20">

                     <label>Name<span>*</span></label>

                     <input class="addformEmpty" type="text" id="add_name" name="name" value="" placeholder="Enter Name">    

                  </div>

                  <div class="col-md-6 mb-20">

                        <label>Mobile Number  <span>*</span></label>

                        <input type="tel" id="add_mobile_number" class="phone phoneClass addformEmpty" maxlength="10" required="" value="+91" name="mobile_number" />

                        <input type="hidden" class="form-control" name="isd_code" id="isd_code1" value="91">

                        <input type="hidden" class="form-control" name="isd_flag" id="isd_flag1" value="in">

                  </div>



                  <div class="col-md-6 mb-20">

                     <label>Pincode</label>

                     <input class="addformEmpty" type="text"  id="add_pincode" name="pincode" value="" placeholder="Enter Pincode">     

                  </div>

                  <div class="col-md-6 mb-20">

                     <label for="country">City <span>*</span></label>

                      <input type="text" class="addformEmpty" name="city" id="add_city" value="" placeholder="Enter City">  

                  </div>
                  
                  <div class="col-md-6 mb-20">

                     <label for="country">Street <span>*</span></label>

                      <input type="text" class="addformEmpty" name="street" id="add_street" value="" placeholder="Enter Street">  

                  </div>
                  
                  <div class="col-md-6 mb-20">

                     <label for="country">Street 2</label>

                      <input type="text" class="addformEmpty" name="street2" id="add_street2" value="" placeholder="Enter Street 2">  

                  </div>   
                  
                  <div class="col-12 mb-10 contact_message">

                     <label>Address  <span>*</span></label>

                     <textarea name="address" id="add_address" value="" placeholder="Address" class="form-control2 addformEmpty"  rows="2"></textarea>     

                  </div>

                  <div class="contact_message text-center">

                     <button type="button" id="submitAddAdrressButton"> Add Address </button>

                  </div>

               </div>

            </form>

         </div>

      </div>

   </div>

</div>

<!-- End Address Screen-->



<!-- Edit Address Screen-->

<div class="modal fade addresModal" id="editAddress" tabindex="-1" role="dialog"  aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">

         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

         <span aria-hidden="true"><i class="icon-x"></i></span>

         </button>

         <div class="modal_body checkout_form">

           <form id="editFormForAddress" method="post" action="{{url('/'.$slug.'/update-my-addresses')}}">

                @csrf

                <h4>Edit Address</h4>

                <div class="row">

                

                  <div class="col-md-6 mb-20">

                  	

                    <input type="hidden" name="id" id="EditAddressId" value="">



                    <input type="hidden" name="user_id" id="edit_user_id" value="">

                     <label>Name</label>

                     <input type="text" name="name" id="edit_name" value="" >    

                  </div>

                  <div class="col-md-6 mb-20">

                        <label>Mobile Number </label>

                        <input type="tel" id="edit_mobile_number" class="phone phoneEditClass" maxlength="10" required="" value="" name="mobile_number" />

                   

                        <input type="hidden" class="form-control edit_isd_code isd_code2_class" name="isd_code" id="" value="">

                        

                        <input type="hidden" class="form-control edit_isd_flag" name="isd_flag" value="">



                  </div>



                  <div class="col-md-6 mb-20">

                     <label>Pincode</label>

                     <input type="text"  name="pincode" id="edit_pincode" value="">     

                  </div>

                  <div class="col-md-6 mb-20">

                     <label for="country">City <span>*</span></label>

                     <input type="text"  name="city" id="edit_city" value="">  

                  </div>

                  <div class="col-12 mb-10 contact_message">

                     <label>Address  <span>*</span></label>

                     <textarea placeholder="Address"  name="address" id="edit_address" class="form-control2" rows="2"></textarea>     

                  </div>

                  <div class="contact_message text-center">

                     <button type="submit" id="submitEditAdrressButton"> Update Address </button>

                  </div>

               </div>

            </form>

         </div>

      </div>

   </div>

</div>

<!-- End Edit Address Screen-->



<!-- Add Card Screen-->

<div class="modal fade addresModal" id="addCard" tabindex="-1" role="dialog"  aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">

         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

         <span aria-hidden="true"><i class="icon-x"></i></span>

         </button>

         <div class="modal_body checkout_form">

            <form action="#">

               <h4>Add New Card</h4>

               <div class="row">

                  <div class="col-md-12 mb-20">

                     <label>Card Holder Name<span>*</span></label>

                     <input type="text" placeholder="Add Name">    

                  </div>

                  <div class="col-md-12 mb-20">

                     <label>Card Number  <span>*</span></label>

                     <input type="text" placeholder="XXXX XXXX XXXX XXXX"> 

                  </div>

                  <div class="col-md-6 mb-20">

                     <label>Expires</label>

                     <input type="text" placeholder="MM/YYYY">     

                  </div>

                  <div class="col-md-6 mb-20">

                     <label for="country">CVV <span>*</span></label>

                      <input type="text" placeholder="Add CVV">  

                  </div>

                  <div class="contact_message text-center">

                     <button type="submit"> Add Card </button>

                  </div>

               </div>

            </form>

         </div>

      </div>

   </div>

</div>

<!-- End Card Screen-->



<!-- Delete Popup -->

<div class="modal fade optScreen otpNumber" id="deletePopup" tabindex="-1" role="dialog"  aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">

         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

         <span aria-hidden="true"><i class="icon-x"></i></span>

         </button>

         <form>         

             <div class="modal_body text-center delPop">

                <h5>Are you sure? <br />You want to delete this address?</h5>

                <input type="hidden" name="userAddressId" value="" id="">

                <div class="contact_message text-center">

                   <button type="button" id="deleteAddressModalButton"> Delete </button>

                </div>

             </div>

         </form>



      </div>

   </div>

</div> 

<!-- End Delete Popup -->





<!-- Delete Popup -->

<div class="modal fade optScreen otpNumber" id="deleteCard" tabindex="-1" role="dialog"  aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">

         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

         <span aria-hidden="true"><i class="icon-x"></i></span>

         </button>

         <div class="modal_body text-center delPop">

            <h5>Are you sure? <br /> You want to delete this card?</h5>

            <div class="contact_message text-center">

               <button type="submit"> Delete </button>

            </div>

         </div>

      </div>

   </div>

</div> 

@if(Auth::check())

    <input  type="hidden" class="userId" name="userId" value="{{Auth::user()->id}}">

@else
    @php 
    $cookie_name = "guestId";
    if(!isset($_COOKIE[$cookie_name]) && empty($_COOKIE[$cookie_name])) {
        $cookie_value = date('Ymdhis');
        setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
        $_COOKIE['guestId'] = $cookie_value;
    }    
    @endphp
    <input  type="hidden" class="userId" name="userId" value="{{ $_COOKIE['guestId']}}">



@endif

<!-- End Delete Popup -->



<!-- modal area end-->

<!--    <div class="modal fade optScreen otpNumber" id="seeOption" tabindex="-1" role="dialog"  aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">

         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

         <span aria-hidden="true"><i class="icon-x"></i></span>

         </button>

         <div class="modal_body">

            <h1>Get your OTP on</h1>

            <div class="contact_message text-center">

               <div class="optionfLEX mt-5">

                  <div class="tile"><img alt="Call" src="assets/img/phone.png"><span class="section-text-6">Call</span></div>

                  <div class="divider"></div>

                  <div class="tile"><img alt="WhatsApp" src="assets/img/whatsapp.png"><span class="section-text-6">WhatsApp</span></div>

               </div>

            </div>

         </div>

      </div>

   </div>

   </div> -->

<!-- modal area end-->



<div class="modal fade optScreen otpNumber" id="useAddressDefaultPopup" tabindex="-1" role="dialog"  aria-hidden="true">

   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">

         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

         <span aria-hidden="true"><i class="icon-x"></i></span>

         </button>

         <form id="updateDefaultAddressForm" method="POST" action="{{url('/'.$slug.'/default-my-addresses')}}" >

             <div class="modal_body text-center delPop">

               @csrf

                  <h5>Are You Sure? <br /> You want to use this address as default?</h5>

                  <input type="hidden" name="address_id" class="adrs_id_cls">
                  <input type="hidden" name="slug" value="{{$slug}}">



                  <div class="contact_message text-center">

                     <!-- <button type="button" id="defaultAddressModalButton"> Use as default </button> -->

                     <button type="button" class="btn btn_theme updt_default_card"><span>Confirm</span></button>



                  </div>

             </div>

         </form>

      </div>

   </div>

</div>

<input type="hidden" name="slug" value="{{$slug}}">


<script src="{{ url('frontend/assets/js/vendor/jquery-3.4.1.min.js') }}"></script>
   <script type="text/javascript">
      /*---slider-range here---*/
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 10000,
            values: [ 0, 10000 ],
            slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            $( "#min_sidebar_filter" ).val(ui.values[ 0 ] );
            $( "#max_sidebar_filter" ).val(ui.values[ 1 ] );    
           }
        });
   </script>
   
<script src="{{ url('frontend/assets/js/jquery.validate.js') }}"></script>





<script src="{{ url('frontend/assets/js/popper.js') }}"></script>

<script src="{{ url('frontend/assets/js/bootstrap.min.js') }}"></script>

<script src="{{ url('frontend/assets/js/owl.carousel.min.js') }}"></script>

<script src="{{ url('frontend/assets/js/slick.min.js') }}"></script>

<script src="{{ url('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>

<script src="{{ url('frontend/assets/js/jquery.ui.js') }}"></script>

<script src="{{ url('frontend/assets/js/jquery.elevatezoom.js') }}"></script>

<script src="{{ url('frontend/assets/js/isotope.pkgd.min.js') }}"></script>

<script src="{{ url('frontend/assets/js/slinky.menu.js') }}"></script>

<script src="{{ url('frontend/assets/js/tippy-bundle.umd.js') }}"></script>

<script src="{{ url('frontend/assets/js/plugins.js') }}"></script>



<script src="{{ url('frontend/assets/js/main.js') }}"></script>

<script src="{{ url('frontend/assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>

<script type="text/javascript" src="{{asset('frontend/assets/js/toastr.min.js')}}"></script>


<script>
    $(window).on('load', function() { // makes sure the whole site is loaded
      $('#loader').fadeOut(); // will first fade out the loading animation
      $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
      $('body').delay(350).css({'overflow':'visible'});
    })
</script>


<!-- session message start -->

<script>
  

    @if(Session::has('success'))

        $(function () {

            toastr.options = {

                "closeButton": true,

                "debug": false,

                "newestOnTop": false,

                "progressBar": true,

                "positionClass": "toast-top-right",

                "preventDuplicates": false,

                "onclick": null,

                "showDuration": "300",

                "hideDuration": "1000",

                "timeOut": "10000",

                "extendedTimeOut": "1000",

                "showEasing": "swing",

                "hideEasing": "linear",

                "showMethod": "fadeIn",

                "hideMethod": "fadeOut"

            };

            toastr.success("{{ Session::get('success') }}");

        });

    @endif    

    @if(Session::has('error'))

        $(function () {

            toastr.options = {

              "closeButton": true,

              "debug": false,

              "newestOnTop": false,

              "progressBar": true,

              "positionClass": "toast-top-right",

              "preventDuplicates": false,

              "onclick": null,

              "showDuration": "300",

              "hideDuration": "1000",

              "timeOut": "10000",

              "extendedTimeOut": "1000",

              "showEasing": "swing",

              "hideEasing": "linear",

              "showMethod": "fadeIn",

              "hideMethod": "fadeOut"

            };

            toastr.error("{{ Session::get('error') }}");

        });

    @endif  

</script>









<script src="{{ url('frontend/assets/js/intlTelInput.js')}}"  type="text/javascript"></script>

<script src="{{ url('frontend/assets/js/intlTelInput-jquery.js')}}" type="text/javascript"></script>



<!-- Load the intl-tel-input script -->





<script type="text/javascript">

    // IntlTelInput Plugin Initialization

    var inputIntl=$(".phone").intlTelInput({             

      allowDropdown: true,

      autoHideDialCode: true,

      autoPlaceholder: "",

      dropdownContainer: document.body,

      // excludeCountries: ["us"],

      // formatOnDisplay: false,

      geoIpLookup: function(callback) {

        $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {

          var countryCode = (resp && resp.country) ? resp.country : "";

          callback(countryCode);

          console.log(resp);

        });

      },

      nationalMode: false,

      preferredCountries: [],

      separateDialCode: true,

      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",

    });



</script>



<script type="text/javascript">

       

    $(".phone").on("countrychange", function(e, countryData) {

        var dial_code = $(".phone").intlTelInput("getSelectedCountryData").dialCode;

        $('#isd_code').val(dial_code);

        var flagClass = $(".phoneClass").intlTelInput("getSelectedCountryData").iso2; 

    });



    $(".phoneClass").on("countrychange", function(e, countryData) {

        var dial_code = $(".phoneClass").intlTelInput("getSelectedCountryData").dialCode;

        $('#isd_code1').val(dial_code);

        var flagClass = $(".phoneClass").intlTelInput("getSelectedCountryData").iso2; 

        $('#isd_flag1').val(flagClass);



    });



    $(".phoneEditClass").on("countrychange", function(e, countryData) {

        console.log('here');

        // country.val(iti.getSelectedCountryData().iso2);

        var dial_code = $(".phoneEditClass").intlTelInput("getSelectedCountryData").dialCode;

        $('.isd_code2_class').val(dial_code);

        var flagClass = $(".phoneClass").intlTelInput("getSelectedCountryData").iso2; 

    });



    



</script>



<script>

   $('#filterIcon').click(function(){

      $('.sidebar_widget').toggleClass('tranformUpper');

   })  

</script>



<script type="text/javascript">



    $(document).on('click', '.categoryProductClass', function(){

        $('.categoryProductClass').css("font-weight", "");

        $(this).css("font-weight", "bold");

        var categoryId  = $(this).attr('category');
        $('.select_option').val(categoryId);
        $('.select_option').niceSelect('update');
        console.log(categoryId)
        $('#selectedCategoryId').val(categoryId);
        var slug = $("input[name=slug]").val()
        var csrf_token  = $('meta[name=csrf-token]').attr('content');
        var max = $('#max_sidebar_filter').val();
        var min = $('#min_sidebar_filter').val();
        var selectedStorageView = localStorage.getItem('selectedProductView');
        // alert(selectedStorageView);
        $.ajax({

            url: "{{ url('/home/category-wise/product') }}",
            data: {selectedStorageView:selectedStorageView,categoryId:categoryId,slug:slug,_token:csrf_token,max:max,min:min},
            type: 'POST',
            success: function (data) {
                var data = JSON.parse(data);
                $('.category_wise_class').html(data.html);
                $('.dataHtmlCount_class').html(data.htmlForPages);
             }         

        });

    });

</script>



<!-- //render order status according data -->

<script type="text/javascript">

    $(document).on('change', '#myOrderStausId', function(){

        var status_Id  = $(this).val();

        var slug        = $(this).attr('slug');

        var csrf_token  = $('meta[name=csrf-token]').attr('content');

        console.log(status_Id,slug)

        

        $.ajax({

            url: "{{ url('/') }}"+'/'+slug+'/render-my-orders' ,

            data: {status_Id:status_Id,slug:slug,_token:csrf_token},

            type: 'POST',

            success: function (data) {

                $('.order_status_wise_class').html(data);

             }         

        });

    });

</script>


<!-- 
<script type="text/javascript">

    $(document).on('click', '#filterSubmitButton', function(event){

        var slug               = $("input[name=slug]").val();
        var max_sidebar_filter = $('#max_sidebar_filter').val();
        var min_sidebar_filter = $('#min_sidebar_filter').val();
        var csrf_token      = $('meta[name=csrf-token]').attr('content');
        var formdata 		= $('#sidebar_filter').serialize();
        console.log(formdata)
        $.ajax({
            url: "{{ url('/') }}"+'/'+slug ,
            data: formdata,
            type: 'get',
            success: function (data) {
            }         
        });
    });
</script> -->


<script type="text/javascript">

    $(document).on('click','.productDisplayView',function(){
        console.log($(this).attr('title'));
        localStorage.setItem('selectedProductView',$(this).attr('title'));
    })

    $(document).on('click','.productCart',function(e) {
            e.preventDefault();
        
        var productId    =  $(this).attr('product');
        var userId       = $('.userId').val();
        slug             = $("input[name=slug]").val();
        var quantity     = 1;

        $.ajax({
            url: "{{ url('/') }}"+'/'+slug+'/cart/add-Product' ,
            type:'post',
            data:{quantity:quantity,slug:slug,productId:productId,userId:userId,_token:"{{ csrf_token() }}" },
            success:function(response){
                if(response['status']=="true") {   
                    if(window.location.href.indexOf('reload')==-1) {
                         window.location.replace(window.location.href+'?reload');
                     } 
                    toastr.success(response.msg); 
                    $('.cart-count').html('<span class="cart-count" style="color: red;">'+response.count+'</span>');
                     // location.reload(); 
                }else{
                    window.location.href = "{{ url('/') }}"+'/'+slug+'/view-cart-detail';
                }
            }
        })    
    })


   $(document).ready(function(){ 
       var view = localStorage.getItem('selectedProductView');
       if(view=='List') {
            $('[data-role=grid_list]').trigger('click')
        }
   })

</script>



<script type="text/javascript">

   $(document).ready(function(){ 
        $(document).on('keyup','.quantityAddToCart',function(){
            var val=parseInt($(this).attr('max').replace(/\D/g,''));
            var $ths = parseInt($(this).val().replace(/\D/g,''));
            console.log(val,$(this).val())
            if($ths > val){
                console.log('hi')
                $(this).val(val)
            }else{
                $(this).val($ths);
            }
        })

        $(document).on('click','.product_size',function(){
            // console.log($(this).attr('prize'))
            var sizePrize    = $(this).attr('prize');
            var sizeQuantity = $(this).attr('quantity');
            var oldRejectedPrize    = $(this).attr('oldRejectedPrize');
      
            console.log(sizePrize,oldRejectedPrize)
            var maxQuantity = $('.quantityAddToCart').attr('max');
        
            var usedSizeQunatity = $(this).attr('usedSizeQunatity');    
            var balanceQuantity  = sizeQuantity - usedSizeQunatity;
            $('.current_price').text('$'+ sizePrize);
            if(oldRejectedPrize){
               $('.old_price').text('$'+ oldRejectedPrize);
            }else{
               $('.old_price').text('');
            }
            if(maxQuantity > sizeQuantity){
               // console.log('if    sizeQuantity->' + sizeQuantity + '   max-qunatity ->'+maxQuantity)
                $('.quantityAddToCart').attr('max',balanceQuantity);
                $('.quantityAddToCart').val(1);
            }else{
               // console.log('else    sizeQuantity->' + sizeQuantity + '  max-qunatity ->'+maxQuantity)
                $('.quantityAddToCart').attr('max',balanceQuantity);
                $('.quantityAddToCart').val(1);   
            }
        })
        
        $(document).on('click','.product_color',function(){
            var colorProduct = $(this).val();
            console.log(colorProduct)
                $('.quantityAddToCart').val(1);   
        })


       $( ".addProductCartDetail" ).click(function() {
         var productId    =  $(this).attr('product');
         var userId       =  $(this).attr('userId');
         var slug         =  $(this).attr('slug');
         var quantity     =  $('.quantityAddToCart').val();
         var product_size = $('.product_size:checked').attr('sizeId')
         // var product_color = $('.product_color:checked').attr('colorId')
         

         // console.log(product_color)
           $.ajax({

                   url: "{{ url('/') }}"+'/'+slug+'/cart-from-description/add-Product' ,

                   type:'post',

                   data:{product_size:product_size,quantity:quantity,slug:slug,productId:productId,userId:userId,_token:"{{ csrf_token() }}" },

                   success:function(response){

                       if(response['status']=="true") {   

                           if(window.location.href.indexOf('reload')==-1) {

                                window.location.replace(window.location.href+'?reload');

                            } 

                           toastr.success(response.msg); 

                           $('.cart-count').html('<span class="cart-count" style="color: red;">'+response.count+'</span>');

                            location.reload(); 

                       }else{

                        console.log(response);

                           toastr.error(response.msg);

                       }

                   }

               })

       });

   })

</script>



<script type="text/javascript">

    // $(document).ready(function(){ 
      $(document).on('click','#mobile_verification_form_submit',function() {
        // $( "#mobile_verification_form_submit" ).click(function() {

            var mobile_number  = $("#mobile_number_optForm").val();
            var slug           = $("input[name=slug]").val();
            var isd_code       = $("input[name=isd_code]").val();
            console.log(mobile_number)

            // return false;

            if ($('#register_with_login').valid()) {

               $.ajax({

                    url: "{{ url('/') }}"+'/'+slug+'/register-with-number' ,

                    type:'post',

                    data:{isd_code:isd_code,mobile_number:mobile_number,slug:slug,_token:"{{ csrf_token() }}" },

                    success:function(response){

                       if(response['status']=="true") { 

                            $('#user_id_otp').val(response['userId'])

                            console.log(response);  

                            toastr.success(response.msg);

                            $('#optScreen').modal('hide')



                            $('#otpNumber').modal('show')

                       }else{

                           console.log(response);

                           toastr.error('Something went wrong');

                       }

                    }

               })

            }

       });

   // })

</script>



<script type="text/javascript">

    $(document).ready(function(){ 

        $( "#otp_form_submit" ).click(function() {
            var otp            = $("input[name=otp]").val();
            var userId         = $("input[name=userId]").val();
            var slug           = $("input[name=slug]").val();

            // return false;
            if ($('#otp_form').valid()) {
                var WithoutLogin_final_price            = $(".WithoutLogin_final_price").val();
                var WithoutLogin_tax                    = $(".WithoutLogin_tax").val();
                var WithoutLogin_grand_total_price      = $(".WithoutLogin_grand_total_price").val();

               $.ajax({
                    url: "{{ url('/') }}"+'/'+slug+'/otp-verification' ,
                    type:'post',
                    data:{WithoutLogin_final_price:WithoutLogin_final_price,WithoutLogin_tax:WithoutLogin_tax,WithoutLogin_grand_total_price:WithoutLogin_grand_total_price,otp:otp,userId:userId,slug:slug,_token:"{{ csrf_token() }}" },

                    success:function(response){

                       if(response['status']=="true") { 
                            console.log(response);  
                            toastr.success(response.msg);
                            $('#otpNumber').modal('hide');
                            window.location.replace("{{ url('/') }}"+'/'+slug+'/my-orders');

                       }else{

                           console.log(response);

                           toastr.error(response.msg);

                       }

                    }

               })

            }

       });

   })

</script>



<script type="text/javascript">

    // $(document).ready(function(){ 

        $(document).on('click','#submitAddAdrressButton',function() {

            var slug            = $("input[name=slug]").val();

            var name            = $("#add_name").val();

            var mobile_number   = $("#add_mobile_number").val();

            var isd_code        = $("#isd_code1").val();

            var pincode         = $("#add_pincode").val();

            var city            = $("#add_city").val();
            
            var street          = $("#add_street").val();
        
            var street2         = $("#add_street2").val();

            var address         = $("#add_address").val();

            var isd_flag        = $("#isd_flag1").val();



            // console.log(isd_flag)



            if ($('#addFormForAddress').valid()) {

               $.ajax({

                    url: "{{ url('/') }}"+'/'+slug+'/add-my-addresses' ,

                    type:'post',

                    data:{isd_flag:isd_flag,isd_code:isd_code,address:address,city:city,street:street,street2:street,pincode:pincode,name:name,mobile_number:mobile_number,slug:slug,_token:"{{ csrf_token() }}" },

                    success:function(response){



                     var data = JSON.parse(response);

                       if(data.response.status=="true") { 

                            console.log(response);  

                            $('#addAddress').modal('hide')

                            toastr.success(data.response.msg);

                            // get-all-addresses

                             $('.category_wise_class').html(data.renderData);

                             $('.render_address_class').html(data.renderData2);

                            

                              location.reload(); 

                             

                       }else{

                           toastr.error('Something went wrong');

                       }

                    }

               })

            }

       });

   // })

</script>

<script type="text/javascript">

    $(document).on('click','#submitEditAdrressButton',function (e) {

        e.preventDefault();



        var slug            = $("input[name=slug]").val();

        var name            = $("#edit_name").val();

        var isd_code        = $(".edit_isd_code").val();

        var mobile_number   = $("#edit_mobile_number").val();

        var pincode         = $("#edit_pincode").val();

        var city            = $("#edit_city").val();

        var address         = $("#edit_address").val();

        var id         		= $("#EditAddressId").val();



        if ($('#editFormForAddress').valid()) {

           $.ajax({

                url: "{{ url('/') }}"+'/'+slug+'/update-my-addresses' ,

                type:'post',

                data:{id:id,isd_code:isd_code,address:address,city:city,pincode:pincode,name:name,mobile_number:mobile_number,slug:slug,_token:"{{ csrf_token() }}" },

                success:function(response){

                   var data = JSON.parse(response);

                   console.log(data);

                   if(data.response.status=="true") { 

                        console.log(response);  

                        $('#editAddress').modal('hide')

                        toastr.success(data.response.msg);

                        $('.category_wise_class').html(data.renderData);



                   }else{

                       toastr.error('Something went wrong');

                   }

                }

           })

        }

   });

</script>



<script type="text/javascript">

    $(document).on('click','#deleteButton',function (e) {

    e.preventDefault();



          var slug            = $("input[name=slug]").val();

          var name            = $("#edit_name").val();

          var mobile_number   = $("#edit_mobile_number").val();

          var pincode         = $("#edit_pincode").val();

          var city            = $("#edit_city").val();

          var address         = $("#edit_address").val();



          if ($('#editFormForAddress').valid()) {

             $.ajax({

                  url: "{{ url('/') }}"+'/'+slug+'/update-my-addresses' ,

                  type:'post',

                  data:{address:address,city:city,pincode:pincode,name:name,mobile_number:mobile_number,slug:slug,_token:"{{ csrf_token() }}" },

                  success:function(response){

                     var data = JSON.parse(response);

                     console.log(data);

                     if(data.response.status=="true") { 

                          console.log(response);  

                          $('#editAddress').modal('hide')

                          toastr.success(data.response.msg);

                           $('.category_wise_class').html(data.renderData);

                     }else{

                         toastr.error('Something went wrong');

                     }

                  }

             })

          }

     });    

</script>





<script type="text/javascript">

    $(document).on('click','#deleteAddressModalButton',function (e) {

        e.preventDefault();

            var slug            = $("input[name=slug]").val();

            var userAddressId   = $("input[name=userAddressId]").val();

            $.ajax({

                url: "{{ url('/') }}"+'/'+slug+'/delete-my-addresses' ,

                type:'post',

                data:{slug:slug,userAddressId:userAddressId,_token:"{{ csrf_token() }}" },

                success:function(response){

                    var data = JSON.parse(response);

                    console.log(data);

                    if(data.response.status=="true") { 

                        console.log(response);  

                        $('#editAddress').modal('hide')

                        toastr.success(data.response.msg);

                        $('.category_wise_class').html(data.renderData);

                        $('#deletePopup').modal('hide')

                        location.reload();



                    }else{

                       toastr.error('Something went wrong');

                    }

                }

            })

     });    

</script>



<script type="text/javascript">

    

    $(document).ready(function(){ 

        $("#reigsterModelOpen").click(function() {

            $('#optScreen').modal('show')

        });

    }); 





    $(document).on('click','#addAddressModal',function() {

        $('.addformEmpty').val('');

        $('#addAddress').modal('show')

    });



    $(document).on('click','.checkoutclassAddressSelected',function() {

        $('.plan_wrpr').removeClass('active');

        $(this).children('.plan_wrpr').addClass('active');

        subId = $(this).closest('div').find('.sub_id').val();

        // alert($(this).closest('div').find('.sub_id').val());

        $('#sub_active').val(subId);

        $(this).addClass("plan_wrpr");

    });



    



    $(document).on('click','#deleteAddressModal',function() {

        var addressId = $(this).attr('userAddressId');

        $("input[name=userAddressId]").val(addressId);            

        $('#deletePopup').modal('show')

    });

    

    // defaultAddressModalButton

    $(document).on('click','.use_adrs_btn',function(){

        $('.adrs_id_cls').val($(this).data('id'));

        $('#useAddressDefaultPopup').modal('show');

    });



    $(document).on('click','.updt_default_card',function(e){

        e.preventDefault();

        $('#updateDefaultAddressForm').submit();

    });





    $(document).on('click','#editAddressModal',function() {

        var user_id     = $(this).attr('userid');

        var name        = $(this).attr('name');

        var address     = $(this).attr('address');

        var pincode     = $(this).attr('pincode');

        var city        = $(this).attr('city');

        var userAddressId = $(this).attr('userAddressId');



        var isd_code      = $(this).attr('isd_code');

        var isd_flag      = $(this).attr('isd_flag');

        var mobile_number = $(this).attr('mobile_number');



        // var additionTwo =  isd_code + mobile_number;

        $('#edit_user_id').val(user_id);

        $('#edit_name').val(name); 

        $('#edit_address').val(address); 

        $('#edit_pincode').val(pincode); 

        $('#edit_city').val(city); 

        $('#EditAddressId').val(userAddressId); 

        console.log(isd_flag,'-',isd_code)

        $('#edit_mobile_number').val(mobile_number); 

        $(".phone").intlTelInput("setCountry",isd_flag)             

        $(".iti__selected-dial-code").html(isd_code);

        $('#editAddress').modal('show')

    });


    $(document).on('click','#checkout_button_order_confirm',function(e){
        e.preventDefault();
        var auth = "{{Auth::check()}}";
        var shipQuotes = $('input[name=order_shipping_quotes_data]').val();
        console.log('hiiii');
        var additionalfields = {};
                                  
        $(".additionalFieldsFormData input").each(function(i,a){
            // console.log(i,a,$(a).val());
            additionalfields[i] = {'name':$(a).attr('name'),'value':$(a).val()};
        });

        if(auth!=''){
            console.log('logged in');
            console.log(shipQuotes);
            if(!shipQuotes) { console.log('ship not selected'); }
            return false; 
            selectedsubId        = $('#sub_active').val();
            var defaultAddressId = $("#defaultAddressId").val();
            console.log( defaultAddressId,selectedsubId)

            if(selectedsubId !='' || defaultAddressId !=''){

                slug             = $("input[name=slug]").val();
                var userId       = $("#user_id").val();
                var final_price  = $("#final_price").val();
                var tax          = $("#tax").val();
                var grand_total_price  = $("#grand_total_price").val();

                if(selectedsubId){
                   var selectedAddressId = $('#sub_active').val();
                }else{
                    var selectedAddressId = $("#defaultAddressId").val();
                }

                var myarray = {};
                $(".product_quantity_checkout").each(function(key,val) {
                    var quantity  = $(this).val();
                    myarray[$(this).attr('productid')] = $(this).val();
                }); 

                $.ajax({
                    url: "{{ url('/') }}"+'/'+slug+'/order-create',
                    type:'post',
                    data:{selectedAddressId:selectedAddressId,tax:tax,grand_total_price:grand_total_price,userId:userId,final_price:final_price,myarray:JSON.stringify(myarray),_token:"{{ csrf_token() }}" },

                    success:function(response){
                       if(response['status']=="true") { 
                            $('#userId').val(response['userId'])
                            toastr.success(response.msg);
                            location.href="{{url('/')}}"+'/'+slug+'/order-completed';
                       }else{
                           toastr.error('Something went wrong');
                       }    
                    }
               })

           }else{
                toastr.error('Please select address for the delivery');
           }

        }else{

            //before login

            // $('#addFormForAddress').submit()

            if ($('#addFormForAddress').valid()) {
               var slug            = $("input[name=slug]").val();
               var name            = $("#add_name").val();
               var mobile_number   = $("#add_mobile_number").val();
               var isd_code        = $("#isd_code1").val();
               var pincode         = $("#add_pincode").val();
               var city            = $("#add_city").val();
               var street          = $("#add_street").val();
               var street2         = $("#add_street2").val();
               var address         = $("#add_address").val();
               var isd_flag        = $("#isd_flag1").val();

                var final_price  = $("#final_price").val();
                var tax          = $("#tax").val();
                var grand_total_price  = $("#grand_total_price").val();

                var myarray = {};
                $(".product_quantity_checkout").each(function(key,val) {
                    var quantity  = $(this).val();
                    myarray[$(this).attr('productid')] = $(this).val();

                });

                $.ajax({
                    url: "{{ url('/') }}"+'/'+slug+'/without-login-confirm-order' ,
                    type:'post',
                    data:{additionalfields:additionalfields,isd_flag:isd_flag,isd_code:isd_code,street:street,street2:street2,address:address,city:city,pincode:pincode,name:name,mobile_number:mobile_number,slug:slug,final_price:final_price,tax:tax,grand_total_price:grand_total_price,myarray:JSON.stringify(myarray),_token:"{{ csrf_token() }}" },

                    success:function(response){
                        if(response.status=="true") { 
                            console.log(response);  
                            $('#user_id_otp').val(response.userId)
                            // $('#otpNumber').modal('show')
                            $('#WithoutLogin_final_price').val(response.final_price)
                            $('#WithoutLogin_tax').val(response.tax)
                            $('#WithoutLogin_grand_total_price').val(response.grand_total_price)

                            $('#optScreen').modal('show')
                            
                            toastr.success(response.msg);
                        }else{
                            toastr.error('Something went wrong');
                        }
                   }

                })

            }

        }

    });



    $(document).on('click','#coupon_form_submit',function() { 

        var slug           = $("input[name=slug]").val();

        var coupon_name    = $("#coupon_name_id").val();

        // alert(coupon_name);

        $.ajax({

            url: "{{ url('/') }}"+'/'+slug+'/couponApply',

            type:'post',

            data:{slug:slug,coupon_name:coupon_name,_token:"{{ csrf_token() }}" },

            success:function(response){

                var data = JSON.parse(response);

                console.log(data.response.msg);



                if(data.response.status=="true") { 

                    toastr.success(data.response.msg);

                    $('.cartDetailRenderData').html(data.renderData);

                    $('.cartDetailHeaderRenderData').html(data.renderData2);

                    // location.href="{{url('/')}}"+'/'+slug+'/couponApply';

                }else{

                    toastr.error(data.response.msg);

                    $('.cartDetailRenderData').html(data.renderData);

                    $('.cartDetailHeaderRenderData').html(data.renderData2);



                } 

            }

       })

    });



    $(document).ready(function(){

        $('#register_with_login').validate({

            ignore:[],

            rules:{

                mobile_number:{

                    required:true,

                    number:true

                },

            },

            messages:{

                mobile_number:{

                    required:"Please select mobile number"

                },

            }

        });

    });





    $(document).ready(function(){

        $('#otp_form').validate({

            ignore:[],

            rules:{

                otp:{

                    required:true

                },

            },

            messages:{

                otp:{

                    required:"Please enter 6 digits otp"

                },

            }

        });

    });

    function getShipQuotes()
    {
        
        $.ajax({
            url: "{{ url('/ajax/shipping_quotes_get') }}",
            type:'post',
            data:{_token:"{{ csrf_token() }}" },
            beforeSend: function() {
                $('.order-loader').css('visibility','visible');
            },            
            success:function(response){
                var data = JSON.parse(response);
                console.log(data);
                if(data.total_count > 0 && data.results){
                    console.log('hello');
                    var elm = '.order_shipping_quotes_data';
                    $(data.results).each(function(i,v){
                        console.log(v);
                        var html = '<p><input type="radio" name="order_shipping_quotes_data" value="'+v.object_id+'" checked="checked"><span>Amount : '+v.amount+'</span><span class="provider_name">'+v.provider+'</span><span class="provider_img"><img width="200px" src="https://dev-sandbox.mienvio.mx/'+v.provider_img+'"></span><span class="provider_day">Time : '+v.days+' Days</span></p>';
                        $(elm).append(html);
                        return false;
                    });
                    $('.order_shipping_quotes').show();
                }else{
                    console.log('no shipping method found');
                }
            },
            error: function(xhr) { // if error occured
                $('.order-loader').css('visibility','hidden');
            },
            complete: function() {
               $('.order-loader').css('visibility','hidden');
            },            
        });         
    }

    $(document).ready(function(){

        $('#addFormForAddress').validate({

            ignore:[],

            rules:{

                name:{

                    required:true

                },

                mobile_number:{

                    required:true,

                    number:true

                },

                pincode:{

                    required:true,

                    number:true,

                    min:1

                },

                city:{

                    required:true

                },

                address:{

                    required:true

                },

            },

            messages:{

                name:{

                    required:"Please enter name"

                },

                mobile_number:{

                    required:"Please enter mobile number"

                },

                pincode:{

                    required:"Please enter pincode"

                },

                city:{

                    required:"Please enter city"

                },

                address:{

                    required:"Please enter address"

                },

            }

        });

    });

</script>



</body>

</html>