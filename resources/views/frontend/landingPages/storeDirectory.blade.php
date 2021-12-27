
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
                   <li>Stores Directory</li>
               </ul>
               <h1>Stores Directory</h1>
           </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="blog-area compad">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 col-md-12">
            <div class="row categoryBlog_wise_class">
               
            </div>
         </div>

      </div>
   </div>
</section> -->

<section class="store-main-sec">
    <div class="container">
        <h2 class="store-main-title"><span>Explore</span> best selling categories</h2>
        <div class="row">
            
           
           <?php foreach ($buisnessCategories as $key => $value1): ?>

            <div class="col-md-6 col-lg-4">
                <figure class="store-title-col">
                    <a href="{{url('/stores'.'/'.$value1['id'])}}">
                        <img src="{{@$value1->image ? asset('public/backend/assets/images/buisness_category_image/'.$value1->image):asset('public/backend/assets/images/default.jpg')}}" alt="profile-sample2"/>
                    </a>
                    <figcaption>
                    <a href="{{url('/stores'.'/'.$value1['id'])}}"><h3 class="title3">{{$value1['name']}}</h3></a>
                    </figcaption>
                    
                </figure>
            </div>
           <?php endforeach ?>
        </div>
       
        <!--  <div class="ld-mr-btn text-center">
             <a href="#">Load More</a>
         </div> -->
    </div>
</section>





@include('frontend.landingPages.common.footer')
