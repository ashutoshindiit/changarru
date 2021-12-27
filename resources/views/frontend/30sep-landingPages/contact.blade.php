@include('frontend.landingPages.common.header')

<style>
    header
    {
        background: linear-gradient(93.94deg, #7ED102 -41.2%, #cb8a12 238.88%);
        position: relative;
    }      
    @media (max-width: 991px) 
    {
        header .navbar-collapse
        {
          background: linear-gradient(93.94deg, #7ED102 -41.2%, #cb8a12 238.88%);
        } 
    }     
</style>

<section class="inner-page-banner" style="background-image:url('assets/images/bg.jpg');">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumbs-area">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>Contact</li>
            </ul>
            <h1>Contact Us</h1>
        </div>
			</div>
		</div>
	</div>
</section>

<section class="contact-page-wrap-layout1 compad">
   <div class="container">
      <div class="contact-page-box-layout1">
         <div class="row">
            <div class="col-lg-6">
               <div class="contact-list">
                  <div class="heading-layout5 mg-b-30">
                     <h2>Information</h2>
                  </div>
                
                  <div class="media">
                     <div class="item-icon">
                        <i class="fas fa-map-marker-alt"></i>
                     </div>
                     <div class="media-body">
                        <h5 class="item-title">Address</h5>
                        <ul>
                           <li>PO Box 16122 Collins Street West</li>
                           <li>Victoria 8007 Australia</li>
                        </ul>
                     </div>
                  </div>
                  <div class="media">
                     <div class="item-icon">
                        <i class="far fa-envelope-open"></i>
                     </div>
                     <div class="media-body">
                        <h5 class="item-title">E-Mail</h5>
                        <ul>
                           <li>nfo@example.com</li>
                           <li>test@example.com</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="contact-form-box-layout1">
                  <div class="heading-layout5 mg-b-30">
                     <h2>Talk To Us Anytime</h2>
                  </div>
                  <form class="contact-form-box" id="contact-form" novalidate="true">
                     <div class="row gutters-15">
                        <div class="col-lg-6 col-12 form-group">
                           <label>Name *</label>
                           <input type="text" placeholder="" class="form-control" name="name" data-error="Name field is required" required="">
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                           <label>E-Mail *</label>
                           <input type="email" placeholder="" class="form-control" name="email" data-error="email field is required" required="">
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-6 col-12 form-group">
                           <label>Phone *</label>
                           <input type="text" placeholder="" class="form-control" name="phone" data-error="Phone field is required" required="">
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-6 col-12 form-group">
                           <label>Subject *</label>
                           <input type="text" placeholder="" class="form-control" name="subject" data-error="Subject field is required" required="">
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-12 form-group">
                           <label>Type Your Comment *</label>
                           <textarea placeholder="" class="textarea form-control" name="message" id="form-message" rows="5" cols="20" data-error="Message field is required" required=""></textarea>
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-12 form-group">
                           <button class="btn btn-info custombtn" type="submit">Submit</button>
                        </div>
                     </div>
                     <div class="form-response"></div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


@include('frontend.landingPages.common.footer')

