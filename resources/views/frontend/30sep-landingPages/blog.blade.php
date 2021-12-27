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
            <div class="row">
               <div class="col-lg-6 col-md-6">
                  <div class="single-blog-post">
                     <div class="post-image">
                        <a href="blog-details.php"><img src="assets/images/1.jpg" alt="image"></a>
                        <div class="date">Oct 14, 2021</div>
                     </div>
                     <div class="post-content">
                        <h3><a href="blog-details.php">2021 Insurance Trends And Possible Challenges</a></h3>
                        <p>Luis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                        <a class="btn btn-info custombtn" href="blog-details.php">Read More</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="single-blog-post">
                     <div class="post-image">
                        <a href="blog-details.php"><img src="assets/images/2.jpg" alt="image"></a>
                        <div class="date">Oct 10, 2021</div>
                     </div>
                     <div class="post-content">
                        <h3><a href="blog-details.php">Global Trends in the Life Insurance Industry</a></h3>
                        <p>Luis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                        <a class="btn btn-info custombtn" href="blog-details.php">Read More</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="single-blog-post">
                     <div class="post-image">
                        <a href="blog-details.php"><img src="assets/images/3.jpg" alt="image"></a>
                        <div class="date">Sep 13, 2021</div>
                     </div>
                     <div class="post-content">
                        <h3><a href="blog-details.php">The Best Car Insurance Companies in 2021</a></h3>
                        <p>Luis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                        <a class="btn btn-info custombtn" href="blog-details.php">Read More</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="single-blog-post">
                     <div class="post-image">
                        <a href="blog-details.php"><img src="assets/images/4.jpg" alt="image"></a>
                        <div class="date">Oct 14, 2021</div>
                     </div>
                     <div class="post-content">
                        <h3><a href="blog-details.php">Top Business Meeting Tech Toys for 2021</a></h3>
                        <p>Luis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                        <a class="btn btn-info custombtn" href="blog-details.php">Read More</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="single-blog-post">
                     <div class="post-image">
                        <a href="blog-details.php"><img src="assets/images/5.jpg" alt="image"></a>
                        <div class="date">Oct 10, 2021</div>
                     </div>
                     <div class="post-content">
                        <h3><a href="blog-details.php">Build a Better Brand with Your Office Space</a></h3>
                        <p>Luis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                        <a class="btn btn-info custombtn" href="blog-details.php">Read More</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="single-blog-post">
                     <div class="post-image">
                        <a href="blog-details.php"><img src="assets/images/6.jpg" alt="image"></a>
                        <div class="date">Sep 13, 2021</div>
                     </div>
                     <div class="post-content">
                        <h3><a href="blog-details.php">Best Office Spaces for a Tight Budget</a></h3>
                        <p>Luis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                        <a class="btn btn-info custombtn" href="blog-details.php">Read More</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 col-md-12">
                  <div class="pagination-area">
                     <a href="#" class="prev page-numbers"><i class="fas fa-angle-double-left"></i></a>
                     <a href="#" class="page-numbers">1</a>
                     <span class="page-numbers current" aria-current="page">2</span>
                     <a href="#" class="page-numbers">3</a>
                     <a href="#" class="page-numbers">4</a>
                     <a href="#" class="next page-numbers"><i class="fas fa-angle-double-right"></i></a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-12">
            <aside class="widget-area" id="secondary">
               <section class="widget widget_search">
                  <form class="search-form">
                     <label>
                     <span class="screen-reader-text">Search for:</span>
                     <input type="search" class="search-field" placeholder="Search...">
                     </label>
                     <button type="submit"><i class="fas fa-search"></i></button>
                  </form>
               </section>
               <section class="widget widget_pearo_posts_thumb">
                  <h3 class="widget-title">Popular Posts</h3>
                  <article class="item">
                     <a href="#" class="thumb">
                     <span class="fullimage cover bg1" style=" background-image: url(assets/images/1.jpg);" role="img"></span>
                     </a>
                     <div class="info">
                        <time datetime="2021-06-30">June 10, 2021</time>
                        <h4 class="title usmall"><a href="#">Making Peace With The Feast Or Famine Of Freelancing</a></h4>
                     </div>
                     <div class="clear"></div>
                  </article>
                  <article class="item">
                     <a href="#" class="thumb">
                     <span class="fullimage cover bg1" style=" background-image: url(assets/images/2.jpg);" role="img"></span>
                     </a>
                     <div class="info">
                        <time datetime="2021-06-30">June 10, 2021</time>
                        <h4 class="title usmall"><a href="#">Making Peace With The Feast Or Famine Of Freelancing</a></h4>
                     </div>
                     <div class="clear"></div>
                  </article>
                  <article class="item">
                     <a href="#" class="thumb">
                     <span class="fullimage cover bg1" style=" background-image: url(assets/images/3.jpg);" role="img"></span>
                     </a>
                     <div class="info">
                        <time datetime="2021-06-30">June 10, 2021</time>
                        <h4 class="title usmall"><a href="#">Making Peace With The Feast Or Famine Of Freelancing</a></h4>
                     </div>
                     <div class="clear"></div>
                  </article>
               </section>
               <section class="widget widget_categories">
                  <h3 class="widget-title">Categories</h3>
                  <ul>
                     <li><a href="#">Business</a></li>
                     <li><a href="#">Privacy</a></li>
                     <li><a href="#">Technology</a></li>
                     <li><a href="#">Tips</a></li>
                     <li><a href="#">Uncategorized</a></li>
                  </ul>
               </section>
               <section class="widget widget_recent_comments">
                  <h3 class="widget-title">Recent Comments</h3>
                  <ul>
                     <li>
                        <span class="comment-author-link">
                        <a href="#">Luis ipsum suspendisse ultrices</a>
                        </span>
                        on
                        <a href="#">Hello world!</a>
                     </li>
                     <li>
                        <span class="comment-author-link">
                        <a href="#">Luis ipsum suspendisse ultrices</a>
                        </span>
                        on
                        <a href="#">Hello world!</a>
                     </li>
                     <li>
                        <span class="comment-author-link">
                        <a href="#">Luis ipsum suspendisse ultrices</a>
                        </span>
                        on
                        <a href="#">Luis ipsum suspendisse ultrices</a>
                     </li>
                     <li>
                        <span class="comment-author-link">
                        <a href="#">Luis ipsum suspendisse </a>
                        </span>
                        on
                        <a href="#">Luis ipsum suspendisse ultrices</a>
                     </li>
                  </ul>
               </section>

               <section class="widget widget_tag_cloud">
                  <h3 class="widget-title">Tags</h3>
                  <div class="tagcloud">
                     <a href="#">IT <span class="tag-link-count"> (3)</span></a>
                     <a href="#">Pearo <span class="tag-link-count"> (3)</span></a>
                     <a href="#">Games <span class="tag-link-count"> (2)</span></a>
                     <a href="#">Fashion <span class="tag-link-count"> (2)</span></a>
                     <a href="#">Travel <span class="tag-link-count"> (1)</span></a>
                     <a href="#">Smart <span class="tag-link-count"> (1)</span></a>
                     <a href="#">Marketing <span class="tag-link-count"> (1)</span></a>
                     <a href="#">Tips <span class="tag-link-count"> (2)</span></a>
                  </div>
               </section>
            </aside>
         </div>
      </div>
   </div>
</section>


@include('frontend.landingPages.common.footer')
