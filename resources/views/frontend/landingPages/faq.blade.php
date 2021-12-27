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

<style type="text/css">
.accordion {
  max-width: 100%;
  margin: 0 auto;
  /*border-top: 1px solid #d9e5e8;*/
  padding: unset;
}
.accordion li {
     margin-bottom: 7px;
  position: relative;
  list-style-type: none;
}
.accordion li:last-child{
    border-bottom: unset;
}
.accordion li p {
  display: none;
  padding: 10px 16px 30px;
  color: #222;
  border: 1px  solid #f0f0f0;
  border-top: 0;
}
.accordion a {
   width: 100%;
    display: block;
    cursor: pointer;
    font-weight: 500;
    line-height: 28px;
    font-size: 16px;
     text-indent: 0; 
    user-select: none;
    color: #fff !important;
    background: linear-gradient(93.94deg, #7ED102 -41.2%, #cb8a12 238.88%);
    border-radius: 3px;
    padding: 15px 18px 15px 15px;
}
.accordion a:after {
  width: 8px;
  height: 8px;
  border-right: 1px solid #fff;
  border-bottom: 1px solid #fff;
  position: absolute;
  right: 10px;
  content: " ";
  top: 23px;
  transform: rotate(-45deg);
  -webkit-transition: all 0.2s ease-in-out;
  -moz-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.accordion p {
  font-size: 14px;
  line-height: 2;
  padding: 10px;
}

a.active:after {
  transform: rotate(45deg);
  -webkit-transition: all 0.2s ease-in-out;
  -moz-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
.faq_head {
    /*padding: 20px;*/
    /*background: #0385e3;*/
    /* color: #fff; */
    margin: 20px auto 50px;
    /*border-radius: 3px;*/
}
.faq_head h2{
    font-size: 38px;
    text-transform: uppercase;
    font-weight: 600;
    color: #0385e3;
    margin: 0;
    text-align: center;
    position: relative;
    padding-bottom: 12px;
}
.faq_head h2::before {
    position: absolute;
    left: 50%;
    content: "";
    width: 100px;
    height: 2px;
    background: #666;
    bottom: -1px;
    margin-left: -50px;
}
.faq_head h2::after {
    position: absolute;
    left: 50%;
    content: "";
    width: 100px;
    height: 2px;
    background: #666;
    bottom: -6px;
    margin-left: -63px;
}
.faq_content {
    margin: 0 auto 60px;
}
/*.record_found h2{
    color: #222;
    text-transform: capitalize;
    font-size: 30px;
    margin: 0 auto;
}*/
.record_found img{
    width: 450px;
    object-fit: cover;
}
</style>

<?php 
    $bgImg = asset('public/frontend/landingPage/assets/images/bg.jpg');
?>
<section class="inner-page-banner" style="background-image:url('{{ $bgImg }}');">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumbs-area">
               <ul>
                   <li>
                       <a href="{{url('/home/index')}}">Home</a>
                   </li>
                   <li>FAQ</li>
               </ul>
               <h1>FAQ's</h1>
           </div>
			</div>
		</div>
	</div>
</section>

<section class="compad accordionBox">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(!empty($faqs))
                    <ul class="accordion">
                      <?php foreach ($faqs as $key => $faq): ?>
                          <li>
                              <a>{{@$faq->title}}</a>
                              <p>{!! @$faq->description !!}</p>
                          </li>
                      <?php endforeach ?>
                    </ul>
                @else
                    <div class="record_found text-center">
                        <img src="{{asset('public\frontend\images\record-not-found.png')}}" class="img-fluid" alt="Record not found">
                    </div>
                @endif
            </div>
          </div>
    </div>
</section>

@include('frontend.landingPages.common.footer')


<script>
    (function($) {
        $('.accordion > li:eq(0) a').addClass('active').next().slideDown();

        $('.accordion a').click(function(j) {
                var dropDown = $(this).closest('li').find('p');

                $(this).closest('.accordion').find('p').not(dropDown).slideUp();

                if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                } else {
                        $(this).closest('.accordion').find('a.active').removeClass('active');
                        $(this).addClass('active');
                }
                dropDown.stop(false, true).slideToggle();

                j.preventDefault();
        });
    })(jQuery);
</script>