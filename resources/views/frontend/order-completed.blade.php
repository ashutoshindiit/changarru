@include('frontend.common.header')

<!--Order Completed page section-->
<style>
    .sticky-header.sticky
    {
        position: relative;
    }
    body
    {
        overflow-x: hidden;
    }
</style>
<div class="paddSec">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="text-center order_complete">
               <i class="fa fa-check-circle"></i>
                 <div class="heading_s1">
                  <h3>Your order is completed!</h3>
                 </div>
                  <p>Thank you for your order! Your order is being processed and will be completed within 3-6 hours. You will receive an email confirmation when your order is completed.</p>
                 <div class="cart_button text-center">
                     <a href="{{url('/').'/'.$slug}}"> Continue Shopping </a>
                  </div>
             </div>
         </div>
      </div>
   </div>
</div>
<!--Order Completed page section end-->
<script src="{{ url('frontend/assets/js/vendor/jquery-3.4.1.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
      window.history.pushState(null, "", window.location.href);        
      window.onpopstate = function() {
          window.history.pushState(null, "", window.location.href);
      };
  });
</script>

@include('frontend.common.footer')
