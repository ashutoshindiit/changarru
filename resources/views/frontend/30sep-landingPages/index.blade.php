@include('frontend.landingPages.common.header')

<style>
	@media only screen and (max-width: 767px)
	{
		footer
		{
			margin-top: -200px;
		}
	}
</style>

<?php 
    $dummyImg = asset('public/frontend/landingPage/assets/images/banner.svg');
?>

<section class="bannersection" style="background-image: url('{{ $dummyImg }}');">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>WELCOME TO Changarru.</h2>
				<h1>Create your online</h1>
				<h3>store in three easy steps & start selling your products.</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mattis egestas sem et orci sit feugiat egestas pellentesque. Faucibus ultrices commodo proin habitant. Mauris, sit pellentesque molestie morbi. Ipsum, adipiscing accumsan, egestas ultrices egestas et. Faucibus id sagittis non eu, pretium habitant. Donec faucibus tellus, sollicitudin maecenas.</p>
				<a class="btn btn-info custombtn1" href="#">Get Started</a>
			</div>
			<div class="col-md-6">
				<div class="bannerBox">
					

					<img src="{{asset('public/frontend/landingPage/assets/images/bannerimg1.png')}}" class="bimg1" alt="">
					<img src="{{asset('public/frontend/landingPage/assets/images/bannerimg2.png')}}" class="bimg2" alt="">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="features pb-0">
	<div class="container">
		<div class="row">
			<div class="col-md-5 mb25">
				<div class="divider_line"></div>
				<h2>Our Features</h2>
				<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying</p>
				<a href="#" class="info">See More Information <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}" /></a>
			</div>
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-6">
						<div class="serviceBox">
			                <div class="service-icon iconcolor1">

			                    <span><img src="{{asset('public/frontend/landingPage/assets/images/icon1.svg')}}" /></span>
			                </div>
			                <h3 class="title">Design tools</h3>
			                <div class="divider_line my-4"></div>
			                <p class="description">Make your store popular by designing amazing marketing materials from easy templates right within Changarru.</p>
			            </div>
					</div>
					<div class="col-md-6">
						<div class="serviceBox">
			                <div class="service-icon iconcolor2">

			                    <span><img src="{{asset('public/frontend/landingPage/assets/images/icon2.svg')}}" /></span>
			                </div>
			                <h3 class="title">Restaurant dining</h3>
			                <div class="divider_line my-4"></div>
			                <p class="description">With Dukaan, get more customers to your business, by running an easy to use table booking service, for your restaurant.</p>
			            </div>
					</div>
					<div class="col-md-6">
						<div class="serviceBox">
			                <div class="service-icon iconcolor3">

			                    <span><img src="{{asset('public/frontend/landingPage/assets/images/icon3.svg')}}" /></span>
			                </div>
			                <h3 class="title">Custom domain</h3>
			                <div class="divider_line my-4"></div>
			                <p class="description">Make your store unique by getting your own custom domain name that is easy to remember.</p>
			            </div>
					</div>
					<div class="col-md-6">
						<div class="serviceBox">
			                <div class="service-icon iconcolor4">

			                    <span><img src="{{asset('public/frontend/landingPage/assets/images/icon4.svg')}}" /></span>
			                </div>
			                <h3 class="title">Online payments</h3>
			                <div class="divider_line my-4"></div>
			                <p class="description">Get more sales, by offering seamless and easy payment options on your online store with Changarru.</p>
			            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<section class="commonSection features pb80 mtm mtminus">
	<img src="{{asset('public/frontend/landingPage/assets/images/shape1.svg')}}" class="fixImg" class="img-fluid" />
	<div class="container pt200">
		<div class="row">
			<div class="col-md-6">
				<img src="{{asset('public/frontend/landingPage/assets/images/laptop.png')}}" class="img-fluid mb14" />
			</div>
			<div class="col-md-6 ">
				<h3>Step 1</h3>
				<h2>Name your store</h2>
				<p>The nights you’ve lost, the fights you’ve fought... to find the <br /> perfect name.</p>
				<p>Name your store, choose a category and say a prayer.</p>
				<p>Now is the time to make it happen.</p>
				<a href="#" class="info mt-4 d-block">See More Information <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}" /></a>
			</div>
		</div>
	</div>
</section>

<section class="commonSection features pt-0 pb-0 orderMobile">
	<img src="{{asset('public/frontend/landingPage/assets/images/shape2.svg')}}" class="fixImg1" class="img-fluid" />
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 orb">
				<h3>Step 2</h3>
				<h2>Add your products</h2>
				<p>The nights you’ve lost, the fights you’ve fought... to find the <br /> perfect name.</p>
				<p>Name your store, choose a category and say a prayer.</p>
				<p>Now is the time to make it happen.</p>
				<a href="#" class="info mt-4 d-block">See More Information <img src="assets/images/arrowl.svg" /></a>
			</div>

			<div class="col-md-6 ort">
				<img src="{{asset('public/frontend/landingPage/assets/images/phone.png')}}"  class="img-fluid mt40" />
			</div>
		</div>
	</div>
</section>

<section class="commonSection features pb80">
	<img src="{{asset('public/frontend/landingPage/assets/images/shape3.svg')}}" class="fixImg3" class="img-fluid" />
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6">

				<img src="{{asset('public/frontend/landingPage/assets/images/selling.png')}}" class="img-fluid" />
			</div>
			<div class="col-md-6 ">
				<h3>Step 3</h3>
				<h2>Start selling</h2>
				<p>The moment of truth. The leap of faith.</p>
				<p>This is where it all begins. Your store is ready for the world.</p>
				<p>Start sharing and taking orders. Kaching!</p>
				<a href="#" class="info mt-4 d-block">See More Information <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}" /></a>

			</div>
		</div>
	</div>
</section>

<section class="features pb80">
	<img src="{{asset('public/frontend/landingPage/assets/images/shape4.svg')}}" class="fixImg4" class="img-fluid" />
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 text-center">
                <div class="divider_line m-auto"></div>
				<h2 class="mt-4">Check Our Demo Video</h2>
				<div class="videoBox mt-5" style="background-image: url('assets/images/video.png');">
					<svg version="1.1" id="play" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
					  <path class="stroke-solid" fill="none" stroke="white"  d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
					    C97.3,23.7,75.7,2.3,49.9,2.5"/>
					  <path class="stroke-dotted" fill="none" stroke="white"  d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
					    C97.3,23.7,75.7,2.3,49.9,2.5"/>
					  <path class="icon" fill="white" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"/>
					</svg>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="features pb140">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
                <div class="divider_line m-auto"></div>
				<h2 class="mt-4">Our Featured Blogs</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
		       <div class="sliderBlog">
		       		<div class="owl-slider">
						<div id="blogslider" class="owl-carousel">
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/blog1.png')}}">
			                        <div class="date-blog">05 Aug 2018</div>
			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Internet advertising what Went wrong.</h4>
			                        <p>Having a home based business is a wonderful asset to your life. The main problem time advertise.</p>
			                       	<a href="#" class="info mt-2 d-block">Read More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
			                     </div>
			                  </div>
			                </div> 

			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/blog2.png')}}">
			                        <div class="date-blog">05 Aug 2018</div>
			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Internet advertising what Went wrong.</h4>
			                        <p>Having a home based business is a wonderful asset to your life. The main problem time advertise.</p>
			                       	<a href="#" class="info mt-2 d-block">Read More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
			                     </div>
			                  </div>
			                </div>
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/blog3.png')}}">
			                        <div class="date-blog">05 Aug 2018</div>
			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Internet advertising what Went wrong.</h4>
			                        <p>Having a home based business is a wonderful asset to your life. The main problem time advertise.</p>
			                       	<a href="#" class="info mt-2 d-block">Read More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
			                     </div>
			                  </div>
			                </div>
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/blog4.png')}}">
			                        <div class="date-blog">05 Aug 2018</div>
			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Internet advertising what Went wrong.</h4>
			                        <p>Having a home based business is a wonderful asset to your life. The main problem time advertise.</p>
			                       	<a href="#" class="info mt-2 d-block">Read More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
			                     </div>
			                  </div>
			                </div>
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/blog1.png')}}">
			                        <div class="date-blog">05 Aug 2018</div>
			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Internet advertising what Went wrong.</h4>
			                        <p>Having a home based business is a wonderful asset to your life. The main problem time advertise.</p>
			                       	<a href="#" class="info mt-2 d-block">Read More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
			                     </div>
			                  </div>
			                </div>
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/blog2.png')}}">
			                        <div class="date-blog">05 Aug 2018</div>
			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Internet advertising what Went wrong.</h4>
			                        <p>Having a home based business is a wonderful asset to your life. The main problem time advertise.</p>
			                       	<a href="#" class="info mt-2 d-block">Read More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
			                     </div>
			                  </div>
			                </div>
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/blog3.png')}}">
			                        <div class="date-blog">05 Aug 2018</div>
			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Internet advertising what Went wrong.</h4>
			                        <p>Having a home based business is a wonderful asset to your life. The main problem time advertise.</p>
			                       	<a href="#" class="info mt-2 d-block">Read More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
			                     </div>
			                  </div>
			                </div>
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/blog4.png')}}">
			                        <div class="date-blog">05 Aug 2018</div>
			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Internet advertising what Went wrong.</h4>
			                        <p>Having a home based business is a wonderful asset to your life. The main problem time advertise.</p>
			                       	<a href="#" class="info mt-2 d-block">Read More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
			                     </div>
			                  </div>
			                </div>
		            	</div>
					</div>
		       </div>
			</div>
		</div>
	</div>
</section>

<section class="features">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-left">
                <div class="divider_line"></div>
				<h2 class="mt-4">Our Categories</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3 col-lg-3 col-xl-2">
				<div class="my-owl-nav">
				  <span class="my-next-button">
				    <img src="{{asset('public/frontend/landingPage/assets/images/arrowleft.svg')}}">
				  </span>
				  <span class="my-prev-button">
				    <img src="{{asset('public/frontend/landingPage/assets/images/arrowright.svg')}}">
				  </span>
				</div>
			</div>
			<div class="col-lg-9 col-md-9  col-xl-10">
		       <div class="sliderBlog cateSlider">
		       		<div class="owl-slider">
						<div id="categories" class="owl-carousel newSlider">
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/cat.png')}}">
			                     </div>

			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Product Marketing: Creative Market</h4>
			                        <p>The lorem ipsum is a placeholder text used in blishing and graphic design.</p>
			                       	<a href="#" class="info mt-2 d-block">See More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>

			                     </div>
			                  </div>
			                </div>
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/cat1.png')}}">

			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Sell Art Online</h4>
			                        <p>The lorem ipsum is a placeholder text  graphic design.</p>
			                       	<a href="#" class="info mt-2 d-block">See More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
			                     </div>
			                  </div>
			                </div>
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{asset('public/frontend/landingPage/assets/images/cat2.png')}}">

			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">Sell Clothes Online</h4>
			                        <p>The lorem ipsum is a placeholder text  graphic design..</p>
			                       	<a href="#" class="info mt-2 d-block">See More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
			                     </div>
			                  </div>
			                </div>
		            	</div>
					</div>
		       </div>
			</div>
		</div>
	</div>
</section>



<section class="commonSection features pb80">
	<img src="{{asset('public/frontend/landingPage/assets/images/shape3.svg')}}" class="fixImg3 fixShape3" class="img-fluid" />
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-7 col-xl-6 text-left pl100">
                <div class="divider_line"></div>
				<h2 class="mt-4">Our Happy Clients</h2>
				<div class="sliderBlog cateSlider">
		       		<div class="owl-slider">
						<div id="testimonials" class="owl-carousel testSlider">
			                <div class="item">
			                  	<p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem ipsum dolor sit amet.."</p>
			                </div>
			                <div class="item">
			                  	<p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem ipsum dolor sit amet.."</p>
			                </div>
			                <div class="item">
			                  	<p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem ipsum dolor sit amet.."</p>
			                </div>
		            	</div>
					</div>
		       </div>
		       <div class="my-owl-nav mytop">
				  <span class="my-next-button1">
				    <img src="{{asset('public/frontend/landingPage/assets/images/arrowleft.svg')}}">
				  </span>
				  <span class="my-prev-button1">
				    <img src="{{asset('public/frontend/landingPage/assets/images/arrowright.svg')}}">
				  </span>
				</div>
			</div>
		</div>
	</div>
	<img src="{{asset('public/frontend/landingPage/assets/images/testuser.png')}}" class="clientImg" class="img-fluid" />
</section>

<section class="downloadSection" style="background-image: url('assets/images/footer.png');">
	<img src="{{asset('public/frontend/landingPage/assets/images/user.png')}}" class="img-fluid userImg" />
	<div class="container">
		<div class="row">
			<div class="col-xl-6 offset-xl-4 offset-lg-5 col-lg-6 col-md-8 offset-md-4 plrany">
				<h2>Download our apps for free</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Congue felis, neque, senectus netus ultricies amet fringilla. Sagittis leo cursus ac morbi. Cursus molestie sed ut ornare lacus</p>
				<h3>Also Available On</h3>
				<a href="#"><img src="{{asset('public/frontend/landingPage/assets/images/google.png')}}" class="img-fluid mr-3" /></a>
				<a href="#"><img src="{{asset('public/frontend/landingPage/assets/images/appstore.png')}}" class="img-fluid" /></a>
			</div>
		</div>
	</div>
</section>


@include('frontend.landingPages.common.footer')
