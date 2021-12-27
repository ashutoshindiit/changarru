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
                       <a href="{{url('/home/index')}}">Home</a>
                   </li>
                   <li>Blog Details</li>
               </ul>
               <h1>{{@$blog['slug']}}</h1>
           </div>
			</div>
		</div>
	</div>
</section>

<section class="blog-area compad">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 col-md-12">
            <div class="blog-details-desc">
               <div class="article-image">
                  <img src="{{@$blog['feature_image']?asset('public/backend/assets/images/blog/'.$blog['feature_image']):asset('frontend/images/record-not-found.png')}}" alt="image">
               </div>
               <div class="article-content">
                  <div class="entry-meta">
                     <ul>
                        <li><i class="far fa-clock"></i> <a href="#"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($blog['created_at']))->toDayDateTimeString() ?></a></li>
                        <li><i class="fas fa-user"></i> <a href="#">{{@$admin['full_name']}}</a></li>
                     </ul>
                  </div>
                  <h3>{{@$blog['title']}}</h3>
                  {!! @$blog['content'] !!}
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


<section class="compad pt-0">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div id="disqus_thread"></div>
         </div>
      </div>
   </div>
</section>


@include('frontend.landingPages.common.footer')

  <script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://changarru.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
   <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>