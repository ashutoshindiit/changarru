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
<div class="mt-70 mb-70 pTop">
   <div class="container">
       <div class="row">
                <div class="col-12">
                    <div class="services_title">
                        <h2>{!! @$termAndCondtions['title'] !!}</h2>
                        
                    </div>
                </div>
            </div>
      <div class="row">
         <div class="col-md-12">
            <div class="faq_content_wrapper">
                {!! @$termAndCondtions['description'] !!}
            </div>
         </div>
      </div>
   </div>
</div>
<!--Order Completed page section end-->
@include('frontend.common.footer')