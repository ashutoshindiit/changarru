 <div class="col-md-4 mbnone">
    <div class="service_button">
       <h2><i class="fa fa-phone" aria-hidden="true"></i>+ {{Auth::user()->isd_code}}- {{Auth::user()->mobile_number}}</h2>
       <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
             <a class="nav-link @if($page=='myOrder') active @endif" href="{{url('/'.$slug.'/my-orders')}}" role="tab">
                <i class="fa fa-list" aria-hidden="true"></i> My Orders
             </a>
          </li>
          <li class="nav-item">
             <a class="nav-link @if($page=='address') active @endif" href="{{url('/'.$slug.'/my-addresses')}}">
                <i class="fa fa-map-marker" aria-hidden="true"></i> My Addresses
             </a>
          </li>

          <li class="nav-item">
             <a class="nav-link @if($page=='payment') active @endif" href="{{url('/'.$slug.'/payment-method')}}">
                <i class="fa fa-credit-card-alt" aria-hidden="true"></i> Payment Methods
             </a>
          </li>

          <li class="nav-item">
             <a class="nav-link @if($page=='support') active @endif" href="{{url('/'.$slug.'/support')}}">
                <i class="fa fa-phone" aria-hidden="true"></i> Support
             </a>
          </li>

          <li class="nav-item">
             <a class="nav-link " href="{{url('/'.$slug.'/logout')}}">
                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
             </a>
          </li>
       </ul>
    </div>
 </div>
