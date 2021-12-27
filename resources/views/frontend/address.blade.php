@include('frontend.common.header')

<style>

    .sticky-header.sticky
    {
        position: relative;
    }

    body
    {
        overflow-x: hidden;
    }
    
    .defaultAddress{
      color: orange;
    }

   .plan_wrpr{
        border: 1px solid #ac9b9b;
    }

</style>

<div class="paddSec1">

   <div class="container">

      <div class="row">

        @include('frontend.common.sidebar1')

         <div class="col-md-8">

            <div class="link-order-details-right link-order-details-box addMobHide">

               <div class="hrs-ytsr">

                  <h2>Address <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addAddress" class="brn-rsr"> Add New Card </a> </h2>

               </div>

            </div>



            <div class="sidebarOrder addTop">

                <div class="row category_wise_class rowFlex">

                    <div class="col-md-6 deskTop">

                       <a id="addAddressModal" class="borderBox addAddress">

                             <div class="flexHeight ">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr6"><g fill="var(--brand-3)" fill-rule="nonzero"><path d="M8 0a1 1 0 01.993.883L9 1v14a1 1 0 01-1.993.117L7 15V1a1 1 0 011-1z"></path><path d="M15 7a1 1 0 01.117 1.993L15 9H1a1 1 0 01-.117-1.993L1 7h14z"></path></g></svg>

                               Add new address

                           </div>

                       </a>

                    </div>



                    @if(isset($userAddresses) && sizeof($userAddresses)>0)

                        @foreach($userAddresses as $key => $userAddress)

                            @if(!empty($userAddress))

                                <div class="col-md-6">

                                     <div class="borderBox @if($userAddress['use_address_as_default']=='yes') plan_wrpr @endif">

                                        <div class="business-name-with-log-wrap">

                                           <strong>{{$userAddress['name']}}</strong>

                                        </div>

                                        <div class="order-info-section mt-2">

                                           <div class="order-name-cost-detail">

                                              <div class="mb6">

                                                 <h5 class="order-total-cost text-right">{{@$userAddress['isd_code']}}-{{$userAddress['mobile_number']}}</h5>

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

                                           <a userid="{{$userAddress['user_id']}}" name="{{$userAddress['name']}}" address="{{$userAddress['address']}}" pincode="{{$userAddress['pincode']}}" city="{{$userAddress['city']}}"  isd_code="{{$userAddress['isd_code']}}" mobile_number="{{$userAddress['mobile_number']}}" isd_flag="{{$userAddress['isd_flag']}}" userAddressId="{{$userAddress['id']}}" id="editAddressModal">Edit</a>                                           

                                           <a id="deleteAddressModal" userAddressId="{{$userAddress['id']}}" class="ml2 delte">Delete</a>

                                           <br>

                                           @if($userAddress['use_address_as_default']=='no')
                                               <div class="text-center">
                                                  <button type="button" data-id="{{$userAddress['id']}}" class="btn btn_theme use_adrs_btn delte"><span>Use as Default</span></button>
                                               </div>
                                           @endif

                                        </div>

                                     </div>

                                </div>

                            @endif

                        @endforeach

                    @endif

                </div>

            </div>

         </div>

      </div>

   </div>

</div>

<!--Order Completed page section end-->

@include('frontend.common.footer')



