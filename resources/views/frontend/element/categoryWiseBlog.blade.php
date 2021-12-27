<div class="row categoryBlog_wise_class">
               <?php foreach ($blogs as $key => $value): ?>               
                    <?php
                       $contentDescription =  substr($value['content'], 0, 50);
                    ?>
                   <div class="col-lg-6 col-md-6">
                      <div class="single-blog-post">
                         <div class="post-image">
                            <a href="{{url('home/blog-details/'.$value['slug'])}}">
                                <img src="{{@$value['feature_image']?asset('public/backend/assets/images/blog/'.$value['feature_image']):asset('frontend/images/record-not-found.png')}}" alt="image">

                            </a>
                            <div class="date"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($value['created_at']))->toDayDateTimeString() ?></div>
                         </div>
                         <div class="post-content">
                            <h3><a href="{{url('home/blog-details/'.$value['slug'])}}">{{@$value['title']}}</a></h3>
                            <p>{!! @$contentDescription !!}</p>
                            <a class="btn btn-info custombtn" href="{{url('home/blog-details/'.$value['slug'])}}">Read More</a>
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