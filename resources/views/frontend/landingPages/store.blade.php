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
                   <li>Store</li>
               </ul>
               <h1>Store</h1>
           </div>
            </div>
        </div>
    </div>
</section>
<!-- 
<section class="blog-area compad">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 col-md-12">
            <div class="row categoryBlog_wise_class">
               
            </div>
         </div>

      </div>
   </div>
</section> -->

<section class="store-directry-main-sec">
    <div class="container">

        <div class="store-directry-header">
            <div class="store-directry-title">
                <h2 class="store-main-title">Restaurant & Hotels in <span>Ludhiana</span></h2>
            </div>
            <div class="location-btn">
                <h2 data-toggle="modal" data-target="#location-popup"><i class="fas fa-map-marker-alt"></i> Ludhiana <i class="fas fa-angle-down"></i></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-lg-3">
                <?php foreach ($sellers as $key => $value): ?>
                <div class="store-directry-col">
                    <!-- <a href="{{url('/'.$value['slug'])}}"> -->
                        <div class="store-directry-imgg">
                        <img src="{{$value['store_image']?asset('frontend/assets/img/sellerImage/'.@$value['store_image']):asset('frontend/images/default.jpg')}}">
                    </div>
                    
                    <div class="details">
                        <p class="title">{{$value['buisness_name']}} </p>
                        <p class="locality">{{$value['store_address']}}</p>
                    </div>
                    <!-- </a> -->
                </div>
                <?php endforeach ?>
            </div>
        </div>

        <!--  <div class="ld-mr-btn text-center">
             <a href="#">Load More</a>
         </div> -->
    </div>
</section>


<div class="modal fade" id="location-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="store-main-title">Add Your <span>Location</span></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="location-field">
          <form>
              <input type="text" placeholder="Enter Your Location" name="Loaction">
          </form>
          <div class="location-fields-list">
              <ul>
                <li><i class="fas fa-map-marker-alt"></i></li>
                <li>
                    <h3>Ludhiana</h3>
                    <p>Punjab,India</p>
                </li>
            </ul>
            <ul>
                <li><i class="fas fa-map-marker-alt"></i></li>
                <li>
                    <h3>Ludhiana Railway Station</h3>
                    <p>Punjab,India</p>
                </li>
            </ul>
            <ul>
                <li><i class="fas fa-map-marker-alt"></i></li>
                <li>
                    <h3>Railway Station Road</h3>
                    <p>Punjab,India</p>
                </li>
            </ul>
            <ul>
                <li><i class="fas fa-map-marker-alt"></i></li>
                <li>
                    <h3>Railway Station Car Parking,Civil Lines Side,</h3>
                    <p>Punjab,India</p>
                </li>
            </ul>
            <ul>
                <li><i class="fas fa-map-marker-alt"></i></li>
                <li>
                    <h3>Railway Station Marg</h3>
                    <p>Punjab,India</p>
                </li>
            </ul>

          </div>

      </div>
      </div>

    </div>
  </div>
</div>

@include('frontend.landingPages.common.footer')
