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
                       <a href="{{url('home/index')}}">Home</a>
                   </li>
                   <li>{{$pageData['title']}}</li>
               </ul>
               <h1>{{$pageData['title']}}</h1>
           </div>
			</div>
		</div>
	</div>
</section>

<section class="privacy-policy compad">
   <div class="container">
      <div class="row">
        <div class="col-md-12">
           <h3>{{$pageData['title']}}</h3>
           {!!$pageData['description']!!}
        </div>
      </div>
   </div>
</section>


@include('frontend.landingPages.common.footer')
