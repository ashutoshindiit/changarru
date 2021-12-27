@include('frontend.landingPages.common.header')

<style>
@media only screen and (max-width: 767px)
	{
		footer
		{
			margin-top: -200px;
		}
	}

.mfp-wrap 
	{
	    position: fixed;
	    top: 0;
	    bottom: 0;
	    display:none;
	    left: 0;
	    right: 0;
	    z-index: 9999;
	    background-color: rgba(0, 0, 0, 0.95);
	}

.mfp-container,
.mfp-content,
.mfp-iframe-scaler
{
	height: 100%;
}

	.mfp-close {
    position: absolute;
    right: 25px;
    top: 15px;
    width: 50px;
    height: 50px;
    border-radius: 100%;
    background-color: #fff;
    outline: none;
    border: none;
    font-size: 31px;
}
	
.mfp-wrap iframe
{
	width: 100%;
height: 100%;
margin: 0 auto;
}

.lightbox1 
{
    display:none;
}


.close-btn1 {
    color: grey;
    font-size: 25px;
    position: fixed;
    top: 3%;
    right: 3%;
    z-index: 2;
    -webkit-transform: scale(1, 1);
    -moz-transform: scale(1, 1);
    -ms-transform: scale(1, 1);
    -o-transform: scale(1, 1);
    transform: scale(1, 1);
    -webkit-transition: transform .5s ease, color .5s ease;
    -moz-transition: transform .5s ease, color .5s ease;
    -ms-transition: transform .5s ease, color .5s ease;
    -o-transition: transform .5s ease, color .5s ease;
    transition: transform .5s ease, color .5s ease;
}

.lightbox1 {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 9999;
    background-color: rgba(0, 0, 0, 0.95);
}

.video-wrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 2;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.1);
}
</style>

<?php 
    $dummyImg = asset('public/frontend/landingPage/assets/images/banner.svg');
?>

<section class="bannersection" style="background-image: url('{{ $dummyImg }}');">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<?php 
					$homepageInformation_tit = substr(strip_tags(@$homepageInformation['title']),0,30);
					$homepageInformation_des = substr(strip_tags(@$homepageInformation['description']),0,210) . "...";

					$homepageInformation_feature_des = substr(strip_tags(@$homepageInformation['feature_description']),0,110) . "...";
					// $homepageInformation['feature_title']          
				?>
				<h2>{{@$homepageInformation['page_title']}}</h2>
				<h1>{{strip_tags(@$homepageInformation['title'])}}</h1>
				<p>{!!strip_tags(@$homepageInformation['description'])!!}</p>
				{{--<a class="btn btn-info custombtn1" href="{{url('/store-directory')}}">Descarga desde tu smartphone:</a> --}}
				<p>Descarga desde tu smartphone:</p>
				<a href="{{@$homepageInformation['google_play_store_link']}}"><img src="{{asset('public/frontend/landingPage/assets/images/google.png')}}" class="img-fluid mr-3" /></a>
				<a href="{{@$homepageInformation['apple_play_store_link']}}"><img src="{{asset('public/frontend/landingPage/assets/images/appstore.png')}}" class="img-fluid" /></a>
			</div>
			<div class="col-md-6">
				<div class="bannerBox">
					<img  src="{{@$homepageInformation['banner_image1']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['banner_image1']):asset('frontend/images/default.jpg')}}" class="bimg1" alt="">
					<img  src="{{@$homepageInformation['banner_image2']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['banner_image2']):asset('frontend/images/default.jpg')}}" class="bimg2" alt="">
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
				<h2>{{@$homepageInformation['feature_title']}}</h2>
				<p>{{strip_tags(@$homepageInformation['feature_description'])}}</p>
				{{--<a href='javascript:;' class="info">See More Information <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}" /></a>--}}
			</div>

			<div class="col-md-7">
				<div class="row">
					<?php foreach ($ChangarruFeatures as $key => $ChangarruFeature): ?>
						<?php 
							// $changarruFeature_des = substr(strip_tags(@$ChangarruFeature['feature_description']),0,210) . "...";
						?>
					<div class="col-md-6">
						<div class="serviceBox">
			                <div class="service-icon">
			                	<span><img src="{{$ChangarruFeature['image']?asset('admin/assets/img/Changarrufeature/'.$ChangarruFeature['image']):asset('frontend/images/default.jpg')}}" class="" /></span>
			                </div>
			                <h3 class="title">{{@$ChangarruFeature['feature_name']}}</h3>
			                <div class="divider_line my-4"></div>
			                <p class="description">{{ strip_tags(@$ChangarruFeature['feature_description']) }}.</p>
			            </div>
					</div>
					<?php endforeach ?>	
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
				<img  src="{{@$homepageInformation['step1_image']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['step1_image']):asset('frontend/images/default.jpg')}}" class="img-fluid mb14" />
			</div>
			<div class="col-md-6 ">
				<h3>Paso 1</h3>
				<h2>{{@$homepageInformation['step1_title']}}</h2>
					<p>{!!@$homepageInformation['step1_description']!!}</p>
				
				@if(@$homepageInformation['see_more_information_step_1_button']=='active')
					<a href="{{@$homepageInformation['see_more_information_step_1_link']}}" class="info mt-4 d-block"> {{@$homepageInformation['see_more_information_step_1_name']}} <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}" /></a>
				@endif
			</div>
		</div>
	</div>
</section>

<section class="commonSection features pt-0 pb-0 orderMobile">
	<img src="{{asset('public/frontend/landingPage/assets/images/shape2.svg')}}" class="fixImg1" class="img-fluid" />
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 orb">
				<h3>Paso 2</h3>
				<h2>{{@$homepageInformation['step2_title']}}</h2>
				<p>{!!@$homepageInformation['step2_description']!!}</p>
				@if(@$homepageInformation['see_more_information_step_2_button']=='active')
					<a href="{{@$homepageInformation['see_more_information_step_2_link']}}" class="info mt-4 d-block"> {{@$homepageInformation['see_more_information_step_2_name']}} <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}" /></a>
				@endif
			</div>

			<div class="col-md-6 ort">
				<img src="{{@$homepageInformation['step1_image']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['step2_image']):asset('frontend/images/default.jpg')}}"   class="img-fluid mt40" />
			</div>
		</div>
	</div>
</section>

<section class="commonSection features pb80">
	<img src="{{asset('public/frontend/landingPage/assets/images/shape3.svg')}}" class="fixImg3" class="img-fluid" />
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6">

				<img  src="{{@$homepageInformation['step3_image']?asset('frontend/landingPage/assets/images/'.@$homepageInformation['step3_image']):asset('frontend/images/default.jpg')}}" class="img-fluid" />
			</div>
			<div class="col-md-6 ">
				<h3>Paso 3</h3>
				<h2>{{@$homepageInformation['step3_title']}}</h2>
				<p>{!!@$homepageInformation['step3_description']!!}</p>
				@if(@$homepageInformation['see_more_information_step_3_button']=='active')
					<a href="{{@$homepageInformation['see_more_information_step_3_link']}}" class="info mt-4 d-block"> {{@$homepageInformation['see_more_information_step_3_name']}} <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}" /></a>
				@endif
			</div>
		</div>
	</div>
</section>
<?php 
    $dummyImg_new = asset('public/frontend/landingPage/assets/images/video.png');
    $dummyImg_footer = asset('public/frontend/landingPage/assets/images/footer.png');
?>
{{-- <section class="features pb80">
	<img src="{{asset('public/frontend/landingPage/assets/images/shape4.svg')}}" class="fixImg4" class="img-fluid" />
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 text-center">
                <div class="divider_line m-auto"></div>
				<h2 class="mt-4">{{@$homepageInformation['video_title']}}</h2>

				<div class="videoBox mt-5 buttonNew1" style="background-image: url('{{ $dummyImg_new }}');">
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
</section> --}}
    
     <div id="lightbox1" class="lightbox1">
            <i class="fa fa-times close-btn1"></i>
            <div class="video-wrapper">
                 <video width="960" height="540" controls>
                    <source src="{{asset('frontend/landingPage/assets/images/'.@$homepageInformation['main_video'])}}" type="video/mp4">
                </video> 
            </div>
        </div>
<!---->

<!-- <section class="features pb140">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
                <div class="divider_line m-auto"></div>
				<h2 class="mt-4">{{@$homepageInformation['blog_title']}}</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
		       <div class="sliderBlog">
		       		<div class="owl-slider">
						<div id="blogslider" class="owl-carousel">
			               <?php foreach ($blogs as $key => $value): ?>               
   			                    
   			                    <?php 
   			                    	$contentDescription = substr(strip_tags(@$value['content']),0,50) . "...";
   			                    ?>
			                    <div class="item">
			                  		<div class="blog-grid">
					                    <div class="img-date">
					                        <img src="{{@$value['feature_image']?asset('public/backend/assets/images/blog/'.$value['feature_image']):asset('frontend/images/record-not-found.png')}}">
					                        <div class="date-blog"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($value['created_at']))->toDayDateTimeString() ?></div>
					                    </div>
					                    <div class="discretion-blog">
					                        <h4 class="mb-3">{{@$value['title']}}</h4>
					                       <p>{!! @$contentDescription !!}</p>
					                       	<a href="{{url('/blog-details/'.$value['slug'])}}" class="info mt-2 d-block">Read More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>
					                    </div>
			                   	 	</div>
			               		</div> 
			               <?php endforeach ?>
			             
		            	</div>
					</div>
		       </div>
			</div>
		</div>
	</div>
</section> -->

<section class="features">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-left">
                <div class="divider_line"></div>
				<h2 class="mt-4">{{@$homepageInformation['category_title']}}</h2>
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
			                
			                <?php foreach ($sellerCategories as $key => $val): ?>
			                <div class="item">
			                  <div class="blog-grid">
			                     <div class="img-date">
			                        <img src="{{@$val['image']?asset('public/frontend/assets/img/productCategoryImage/'.$val['image']):asset('public/frontend/images/record-not-found.png')}}">
			                     </div>
			                     <div class="discretion-blog">
			                        <h4 class="mb-3">{{@$val['name']}}</h4>
			                       	<a href='javascript:;' class="info mt-2 d-block">See More <img src="{{asset('public/frontend/landingPage/assets/images/arrowl.svg')}}"></a>

			                     </div>
			                  </div>
			                </div>
			                <?php endforeach ?>

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
				<h2 class="mt-4">{{@$homepageInformation['testimonial_title']}}</h2>
					
				<div class="sliderBlog cateSlider">
		       		<div class="owl-slider">
						<div id="testimonials" class="owl-carousel testSlider">
			                
				<?php foreach ($testimonials as $key => $val1): ?>

					<?php 
						$val1_description = substr(strip_tags(@$val1['description']),0,250) . "...";
					?>
	                <div class="item">
	                  	<p>{{@$val1_description}}</p>
	                  	<br>
	                  	<br>

	                	<h6 style="margin-left: 238px;">{{@$val1['title']}}</h6>
	                </div>
			                
				<?php endforeach ?>
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


<section class="downloadSection" style="background-image: url('{{ $dummyImg_footer }}');">
	<img src="{{asset('public/frontend/landingPage/assets/images/user.png')}}" class="img-fluid userImg" />
	<div class="container">
		<div class="row">
			<div class="col-xl-6 offset-xl-4 offset-lg-5 col-lg-6 col-md-8 offset-md-4 plrany">
				<h2>{{@$homepageInformation['app_title']}}</h2>
				<p>{{@$homepageInformation['app_description']}}</p>
				<h3>Also Available On</h3>
				<a href="{{@$homepageInformation['google_play_store_link']}}"><img src="{{asset('public/frontend/landingPage/assets/images/google.png')}}" class="img-fluid mr-3" /></a>
				<a href="{{@$homepageInformation['apple_play_store_link']}}"><img src="{{asset('public/frontend/landingPage/assets/images/appstore.png')}}" class="img-fluid" /></a>
			</div>
		</div>
	</div>
</section>


@include('frontend.landingPages.common.footer')

<script>
    $(".buttonNew1").on("click", function() {
        $(".lightbox1").fadeIn(1000);
        
        $(this).hide();
        var videoURL = $('#video').prop('src');
        videoURL += "?autoplay=1";
        $('#video').prop('src',videoURL);  
    });
      
      // When the close button is clicked make the lightbox fade out in the span of 0.5 seconds and show the play button
	
      $(".close-btn1").on("click", function() {
      	$('html').attr('style','');
        $(".lightbox1").fadeOut(500);
        $(".buttonNew1").show();
      });

</script>