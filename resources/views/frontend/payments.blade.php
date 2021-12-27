@include('frontend.common.header')



<!--Order Completed page section-->

<div class="paddSec1">

   <div class="container">

      <div class="row">

         @include('frontend.common.sidebar1')

         <div class="col-md-8">

             <div class="sidebarFilter">

               <!--mini cart-->

               <div class="newMini">

                  <div class="cart_close">

                     <div class="cart_text">

                        <h3><i class="fa fa-phone" aria-hidden="true"></i> +91-123456789</h3>

                     </div>

                     <div class="mini_cart_close">

                        <a href="javascript:void(0)"><i class="icon-x"></i></a>

                     </div>

                   </div>

                  <div class="service_button">

                     <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item">

                           <a class="nav-link" href="order.php" role="tab">

                              <i class="fa fa-list" aria-hidden="true"></i> My Orders

                           </a>

                        </li>

                        <li class="nav-item">

                           <a class="nav-link" href="address.php">

                              <i class="fa fa-map-marker" aria-hidden="true"></i> My Addresses

                           </a>

                        </li>



                        <li class="nav-item">

                           <a class="nav-link active" href="payments.php">

                              <i class="fa fa-credit-card-alt" aria-hidden="true"></i> Payment Methods

                           </a>

                        </li>



                        <li class="nav-item">

                           <a class="nav-link " href="support.php">

                              <i class="fa fa-phone" aria-hidden="true"></i> Support

                           </a>

                        </li>



                        <li class="nav-item">

                           <a class="nav-link " href="index.php">

                              <i class="fa fa-sign-out" aria-hidden="true"></i> Logout

                           </a>

                        </li>

                     </ul>

                  </div>

               </div>

            </div>



            <div class="link-order-details-right link-order-details-box px-0">

               <div class="hrs-ytsr">

                  <h2>Saved Card <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addCard" class="brn-rsr"> Add New Card </a> </h2>

               </div>

            </div>

            <div class="sidebarOrder mtpay">

               <div class="row">

                  <div class="col-md-6">

                     <div class="borderBox cardbbox" style="background-image: url('https://dev.indiit.solutions/changarru/frontend/assets/img/card.png');">

                        <div class="business-name-with-log-wrap pos">

                           <span class="anchor-1 order-store-name-txt">John Smith</span>

                        </div>

                     

                        <div class="order-info-section mt-3 pos">

                           <div class="order-name-cost-detail">

                              <div class="d-flex justify-content-between mb6">

                                 <a class="c-black-1 name-hover-cls order-number-txt" href="orderdetails.php">Card</a>

                                 <h5 class="order-total-cost text-right">Visa Ending In 4242</h5>

                              </div>

                              <div class="text-6 d-flex justify-content-between c-gray-1"><span>Expires</span><span class="text-right">02/2025</span></div>

                           </div>

                        </div>

                        <div class="footerEdit mt-3 pos">

                           <a data-bs-toggle="modal" data-bs-target="#deleteCard" class="delte">Delete</a>

                        </div>

                     </div>

                  </div>



                  <div class="col-md-6">

                     <div class="borderBox cardbbox" style="background-image: url('https://dev.indiit.solutions/changarru/frontend/assets/img/card.png');">

                        <div class="business-name-with-log-wrap pos">

                           <span class="anchor-1 order-store-name-txt">John Smith</span>

                        </div>

                     

                        <div class="order-info-section mt-3 pos">

                           <div class="order-name-cost-detail">

                              <div class="d-flex justify-content-between mb6">

                                 <a class="c-black-1 name-hover-cls order-number-txt" href="orderdetails.php">Card</a>

                                 <h5 class="order-total-cost text-right">Visa Ending In 4242</h5>

                              </div>

                              <div class="text-6 d-flex justify-content-between c-gray-1"><span>Expires</span><span class="text-right">02/2025</span></div>

                           </div>

                        </div>

                        <div class="footerEdit mt-3 pos">

                           <a data-bs-toggle="modal" data-bs-target="#deleteCard" class="delte">Delete</a>

                        </div>

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

   </div>

</div>

<!--Order Completed page section end-->

@include('frontend.common.footer')

