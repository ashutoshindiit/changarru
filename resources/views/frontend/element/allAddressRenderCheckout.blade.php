<?php 
    $userAddresses=\App\Models\UserAddress::where('user_id',Auth::user()->id)->get();
?>
<div class="col-md-7 deskTop mb-20">
    <div class="row flexRow">
           
    @if(isset($userAddresses) && sizeof($userAddresses)>0)
        @foreach($userAddresses as $key => $userAddress)
           @if(!empty($userAddress))
                <div class="col-md-6 checkoutclassAddressSelected ">
                    <div class="borderBox  plan_wrpr @if($userAddress['use_address_as_default']=='yes') active @endif ">
                       <div class="business-name-with-log-wrap">
                          <strong>{{$userAddress['name']}}</strong>
                       </div>
                       <div class="order-info-section mt-2">
                          <div class="order-name-cost-detail">
                             <div class="mb6">
                                <h5 class="order-total-cost text-right">+91-{{$userAddress['mobile_number']}}</h5>
                             </div>
                             <div class="address-city-info mb6">
                                <p class="mb-0 ">{{$userAddress['city']}}</p>
                                <p class="mb-2">{{$userAddress['address']}} <span class="pin-seprator mx4"></span> {{$userAddress['pincode']}}</p>
                             </div>
                          </div>
                       </div>
                       <div class="footerEdit">
                          @if($userAddress['use_address_as_default']=='yes')
                              <span class="badg_deflt mb-4 defaultAddress">Default</span>
                          @endif  <br>
                          <br>
                       </div>
                    </div>
                </div>
           @endif
        @endforeach
    @endif  

    </div>
</div>