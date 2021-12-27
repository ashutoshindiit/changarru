@include('frontend.common.header')

<div class="paddSec1">
   <div class="container">
      <div class="row">
        @include('frontend.common.sidebar1')
         <div class="col-md-8">
            <div class="sidebarOrder">
               <div class="orderHeader d-flex justify-content-between align-items-center">
                    <h4>Showing All orders</h4>
                    <form method="get" action="{{url('/'.$slug.'/render-my-orders')}}">
                        @csrf
                        <div class="hover_category">
                            <select class="select_option" id="myOrderStausId" slug="{{$slug}}" name="order_status" type="text" value="">
                                <option selected disabled>Choose Status</option> 
                                @if(isset($orderStatuses) && !empty($orderStatuses)) 
                                    @foreach($orderStatuses as $status)
                                        <option value="{{@$status['id']}}">{{@$status['order_status']}}</option> 
                                    @endforeach 
                                @endif 
                            </select>
                            <input type="hidden" name="slug" value="{{$slug}}"> 
                        </div>
                  </form>
               </div>
               <div class="row mt-4 order_status_wise_class">
                    @include('frontend.element.renderMyOrder')
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


@include('frontend.common.footer')

