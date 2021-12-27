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
	.error{
		color:red !important;
	} 
</style>

<?php 
    $dummyImgAbout = asset('public/frontend/landingPage/assets/images/bg.jpg');    
?>
<section class="inner-page-banner" style="background-image:url('{{ $dummyImgAbout }}');">

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
                    <form action="{{url('/contact-us')}}" method="post" id="contact-us-frontend" class="default-form contact-form-box">
                      @csrf 
                        <div class="row gutters-15">
                            <div class="col-lg-6 col-12 form-group">
                               <label>Name *</label>
                               <input type="text" placeholder="Full name" class="form-control" name="full_name" value="" required="">
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                           <label>E-Mail *</label>
                           <input type="email" name="email"  class="form-control"  placeholder="Email Address" value="" required="">
                        </div>
                        <div class="col-md-6 col-12 form-group">
                           <label>Phone *</label>
						   <input type="text" name="phone"  class="form-control"  placeholder="Phone" value="" required="">
                        </div>
                        <div class="col-md-6 col-12 form-group">
                           <label>Subject *</label>
						     <input type="text" name="subject"  class="form-control"  placeholder="Subject" value="" required="">
                        </div>
                        <div class="col-12 form-group">
                           <label>Type Your message *</label>
						    <textarea name="message" rows="5" cols="20" class="textarea form-control" required=""  placeholder="Message"></textarea>
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

<script>
	$(document).ready(function(){    
		$('#contact-us-frontend').validate({
			rules: {
				full_name: {
					required: true,
				},
				email:{
					required:true,
					email:true,
				},
				phone:{
					required:true,
					number:true,
					min:1,
				},
				subject:{
					required:true,
				},
				message:{
					required:true,
				}
			},
			messages: {
				full_name:{
					required:"Please enter name",
				},
				email:{
					required:"Please enter email address",
				},
				phone:{
					required:"Please enter phone",
				},
				subject:{
					required:"Please enter subject",
				},
				message:{
					required:"Please enter message",
				},
			},
		
		});
	});

</script>