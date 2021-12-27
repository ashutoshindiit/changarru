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
                        <img src="assets/images/about4.png" class="img-fluid" alt="about">
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-12">
                <div class="about-box-layout6">
                    <div class="item-content">
                        <h2 class="item-title">Our History</h2>
                        <p>Timply dummy text of the printing and typesetting industry. Ipsum has been 
                            the industry's standard dummy text ever since the 1500s, when an unknown 
                            printer took a galley of type and scrambled it to make a type specimen book.
                            not only five centuries. Timply dummy text of the printing and typesetting industry. Ipsum has been 
                            the industry's standard dummy</p>
                        <ul class="service-list">
                            <li>Lorem Ipsum is simply </li>
                            <li>Lorem Ipsum is simply  the printing</li>
                            <li>Lorem Ipsum is simply of the printing</li>
                            <li>Lorem Ipsum is simply dummy text of the printing</li>
                        </ul>
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
					<h2 class="title">We create unique digital experiences</h2>
					<p>We build unique digital products that help brands grow, attract new customers, and reach new markets with outstanding graphic design and experience through the digital transformation of various aspects of their businesses.</p>
					<a class="btn btn-info custombtn" href="#">Read More</a>
				</div>
			</div>
			<div class="col-lg-6 m-b30">
				<div class="dlab-media thum-shadow">
					<img src="https://pexp.dexignlab.com/xhtml/images/about/about-2.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
</div>

@include('frontend.landingPages.common.footer')
