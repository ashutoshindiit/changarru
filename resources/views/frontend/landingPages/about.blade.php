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
                        <li>About</li>
                    </ul>
                    <h1>Who we are</h1>
                </div>
			</div>
		</div>
	</div>
</section>

<section class="about-wrap-layout4 compad">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7 col-12">
                <div class="about-box-layout5">
                    <div class="item-img">
                        <img src="{{@$adminAboutUsInformation['image_1']?asset('public/backend/assets/images/adminImage/'.@$adminAboutUsInformation['image_1']):asset('public/backend/assets/images/default.jpg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-12">
                <div class="about-box-layout6">
                    <div class="item-content">
                        <h2 class="item-title">Our History</h2>
                        {!! @$adminAboutUsInformation['image_description_1'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="about-area3 compad">
	<div class="container">
		<div class="row align-items-center about-bx3">
			<div class="col-lg-6">
				<div class="about-content gradient-six text-white">
					{!!@$adminAboutUsInformation['image_description_2']!!}
				</div>
			</div>
			<div class="col-lg-6 m-b30">
				<div class="dlab-media thum-shadow">
					<img src="{{@$adminAboutUsInformation['image_2']?asset('public/backend/assets/images/adminImage/'.@$adminAboutUsInformation['image_2']):asset('public/backend/assets/images/default.jpg')}}" class="img-fluid" alt="about">
				</div>
			</div>
		</div>
	</div>
</div>

@include('frontend.landingPages.common.footer')
