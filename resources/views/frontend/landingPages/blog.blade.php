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

    .categoryBlogClass {
        color: #977373 !important;
        display: block;
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
                       <a href="index.php">Home</a>
                   </li>
                   <li>Blog</li>
               </ul>
               <h1>Blog</h1>
           </div>
			</div>
		</div>
	</div>
</section>

<section class="blog-area compad">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 col-md-12">
            <div class="row categoryBlog_wise_class">
               <?php foreach ($blogs as $key => $value): ?>               
                    <?php
                       $contentDescription =  substr($value['content'], 0, 50);
                    ?>
                   <div class="col-lg-6 col-md-6">
                      <div class="single-blog-post">
                         <div class="post-image">
                            <a href="{{url('/blog-details/'.$value['slug'])}}">
                                <img src="{{@$value['feature_image']?asset('public/backend/assets/images/blog/'.$value['feature_image']):asset('frontend/images/record-not-found.png')}}" alt="image">

                            </a>


                            <div class="date">
                                <?php
                                 // echo \Carbon\Carbon::createFromTimeStamp(strtotime($value['created_at']))->toDayDateTimeString()
                                
                                echo date("d-M-y",strtotime($value['created_at']))
                                ?>        
                            </div>
                         </div>
                         <div class="post-content">
                            <h3><a href="{{url('/blog-details/'.$value['slug'])}}">{{@$value['title']}}</a></h3>
                            <p>{!! @$contentDescription !!}</p>
                            <a class="btn btn-info custombtn" href="{{url('/blog-details/'.$value['slug'])}}">Read More</a>
                         </div>
                      </div>
                   </div>
               <?php endforeach ?>
               <div class="col-lg-12 col-md-12 centred">
                  <div class="pagination-area">
                    {{@$blogs->links("pagination::bootstrap-4")}}
                  </div>
               </div>
            </div>
         </div>

         <div class="col-lg-4 col-md-12">
            <aside class="widget-area" id="secondary">
               <section class="widget widget_search">
                  <form class="search-form" >
                     <label>
                     <span class="screen-reader-text">Search for:</span>
                     <input type="search"  class="search-field blog-search" placeholder="Search...">
                     </label>
                     <button type="button"><i class="fas fa-search"></i></button>
                  </form>
               </section>

               <section class="widget widget_categories">
                  <h3 class="widget-title">Categories</h3>
                    <ul>
                        <li><a class="categoryBlogClass" category="0">All</a></li>
                    </ul>
                    <?php foreach ($blogCategories as $key => $val): ?>
                        <ul>
                           <li><a class="categoryBlogClass" category="{{$val['id']}}">{{@$val['category_name']}}</a></li>
                    <?php endforeach ?>
               </section>
               
            </aside>
         </div>
      </div>
   </div>
</section>


@include('frontend.landingPages.common.footer')
