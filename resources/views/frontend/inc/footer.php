<!--footer area start-->
<footer class="footer_widgets footer_border">
   <div class="footer_bottom">
      <div class="container">
         <!--<div class="row align-items-center">-->
         <!--   <div class="col-md-12 text-center">-->
         <!--      <div class="support">-->
         <!--         <img src="assets/img/support.png" />-->
         <!--         <h3>Customer Support</h3>-->
         <!--         <h4>changarru@changarru.com</h4>-->
         <!--      </div>-->
         <!--      <hr />-->
         <!--   </div>-->
         <!--</div>-->
         <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
               <div class="copyright_area">
                  <p>Copyright © 2021 Changarru. All Rights Reserved.</p>
               </div>
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="footer_payment">
                  <ul>
                     <li><a href="privacy-policy.php" class="text-white">Privacy Policy</a></li>
                     <li><a href="terms-conditions.php" class="text-white">Terms & Conditions</a></li>
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
            <div class="contact_message text-center">
               <div class="inputBox">
                  <span class="prepend-txt">+91</span>
                  <input inputmode="numeric" name="mobile" placeholder="Enter your mobile number" maxlength="10" autocomplete="off" type="tel" value="">
               </div>
               <button type="submit" class="mt-4" data-bs-toggle="modal" data-bs-target="#otpNumber"> Send OTP</button>
            </div>
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
            <h1>OTP Verification</h1>
            <div class="contact_message text-center">
               <h3 class="optsuc">OTP successfully sent.</h3>
               <div class="otpnum">
                  <div class="inflex">
                     <input aria-label="Please enter verification code. Digit 1" autocomplete="off" class=" " type="tel" maxlength="1" value="">
                  </div>
                  <div class="inflex">
                     <input aria-label="Digit 2" autocomplete="off" class=" " type="tel" maxlength="1" value="">
                  </div>
                  <div class="inflex">
                     <input aria-label="Digit 3" autocomplete="off" class=" " type="tel" maxlength="1" value="">
                  </div>
                  <div class="inflex">
                     <input aria-label="Digit 4" autocomplete="off" class=" " type="tel" maxlength="1" value="">
                  </div>
                  <div class="inflex">
                     <input aria-label="Digit 5" autocomplete="off" class=" " type="tel" maxlength="1" value="">
                  </div>
                  <div class="inflex">
                     <input aria-label="Digit 6" autocomplete="off" class=" " type="tel" maxlength="1" value="">
                  </div>
               </div>
               <div class="optFooter">
                  <h3 class="messageOtp">00:30</h3>
                  <!-- <div class="resend-otp-link">
                     <span class="text-8">Didn’t get the code? </span>
                     <a data-bs-toggle="modal" data-bs-target="#seeOption">See other options</a>
                     </div> -->
               </div>
               <a class="mt-3 cusbtn" href="order.php"> Go To Order </a>
            </div>
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
            <form action="#">
               <h4>Add new address</h4>
               <div class="row">
                  <div class="col-md-6 mb-20">
                     <label>Name<span>*</span></label>
                     <input type="text" placeholder="Enter Name">    
                  </div>
                  <div class="col-md-6 mb-20">
                     <label>Mobile Number  <span>*</span></label>
                     <input type="text" placeholder="Enter Mobile Number"> 
                  </div>
                  <div class="col-md-6 mb-20">
                     <label>Pincode</label>
                     <input type="text" placeholder="Enter Pincode">     
                  </div>
                  <div class="col-md-6 mb-20">
                     <label for="country">City <span>*</span></label>
                      <input type="text" placeholder="Enter City">  
                  </div>
                  <div class="col-12 mb-10 contact_message">
                     <label>Address  <span>*</span></label>
                     <textarea placeholder="Address" class="form-control2" rows="2"></textarea>     
                  </div>
                  <div class="contact_message text-center">
                     <button type="submit"> Add Address </button>
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
            <form action="#">
               <h4>Edit Address</h4>
               <div class="row">
                  <div class="col-md-6 mb-20">
                     <label>Name</label>
                     <input type="text" value="test">    
                  </div>
                  <div class="col-md-6 mb-20">
                     <label>Mobile Number </label>
                     <input type="text" value="1234567898"> 
                  </div>
                  <div class="col-md-6 mb-20">
                     <label>Pincode</label>
                     <input type="text" value="123445">     
                  </div>
                  <div class="col-md-6 mb-20">
                     <label for="country">City <span>*</span></label>
                     <input type="text" value="test">  
                  </div>
                  <div class="col-12 mb-10 contact_message">
                     <label>Address  <span>*</span></label>
                     <textarea placeholder="Address" class="form-control2" rows="2">test</textarea>     
                  </div>
                  <div class="contact_message text-center">
                     <button type="submit"> Edit Address </button>
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
         <div class="modal_body text-center delPop">
            <h5>Are You Sure? <br /> You Want to Delete this address?</h5>
            <div class="contact_message text-center">
               <button type="submit"> Delete </button>
            </div>
         </div>
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
            <h5>Are You Sure? <br /> You Want to Delete this Card?</h5>
            <div class="contact_message text-center">
               <button type="submit"> Delete </button>
            </div>
         </div>
      </div>
   </div>
</div> 
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
<!-- JS
   ============================================ -->
<!--jquery min js-->
<script src="assets/js/vendor/jquery-3.4.1.min.js"></script>
<!--popper min js-->
<script src="assets/js/popper.js"></script>
<!--bootstrap min js-->
<script src="assets/js/bootstrap.min.js"></script>
<!--owl carousel min js-->
<script src="assets/js/owl.carousel.min.js"></script>
<!--slick min js-->
<script src="assets/js/slick.min.js"></script>
<!--magnific popup min js-->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery.ui.js"></script>
<!--jquery elevatezoom min js-->
<script src="assets/js/jquery.elevatezoom.js"></script>
<!--isotope packaged min js-->
<script src="assets/js/isotope.pkgd.min.js"></script>
<!--slinky menu js-->
<script src="assets/js/slinky.menu.js"></script>
<!-- tippy bundle umd js -->
<script src="assets/js/tippy-bundle.umd.js"></script>
<!-- Plugins JS -->
<script src="assets/js/plugins.js"></script>
<!-- Main JS -->
<script src="assets/js/main.js"></script>

<script>
   $('#filterIcon').click(function(){
      $('.sidebar_widget').toggleClass('tranformUpper');
   })  

</script>

</body>
</html>