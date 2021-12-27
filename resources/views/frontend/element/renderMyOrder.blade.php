<?php foreach ($allOrder as $key => $value): ?>
      <div class="col-md-6">
          <div class="borderBox">
              <div class="business-name-with-log-wrap">
                 <a class="d-flex align-items-center hover-cls" href="{{url('/'.$slug.'/my-orders/details/'.$value['id'])}}">
                    <img class="" loading="lazy" src="https://api.mydukaan.io/static/images/store-def.jpg" alt="">
                    <span class="anchor-1 order-store-name-txt">{{$value['seller']['buisness_name']}}</span>
                 </a>
              </div>

              <div class="order-info-section mt-3">
                  <div class="order-name-cost-detail">
                      <div class="d-flex justify-content-between mb6">
                          <a class="c-black-1 name-hover-cls order-number-txt" href="{{url('/'.$slug.'/my-orders/details/'.$value['id'])}}">Order #{{$value['id']}}</a>
                           <h5 class="order-total-cost text-right">${{$value['grand_total']}}</h5>
                      </div>
                      <div class="text-6 d-flex justify-content-between c-gray-1"><span>{{$value['order_details_count']}} item</span><span class="text-right"><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($value['created_at']))->toDayDateTimeString() ?></span></div>
                  </div>
              </div>

              <div class="order-status-wrap">
                  <span class="status-text-wrap cancelled">
                      <span class="status-badge"></span>
                      <span class="d-inline-flex">{{ucfirst($value['orderStatus']['order_status'])}}</span>
                  </span>
              </div>

           </div>
        </div>
  <?php endforeach ?>

 @if(count($allOrder)==0)
      <br>
      <div class="text-center">
          <h2 >No Record found</h2>
      </div>
 @endif