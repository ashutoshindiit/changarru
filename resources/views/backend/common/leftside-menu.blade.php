
<div class="left-side-menu">
   <div class="h-100" data-simplebar>
      <div id="sidebar-menu">
         <ul id="side-menu">
            <li class="menu-title">Navigation</li>
            <li>
               <a @if($page='dashboard') class="active" @endif href="{{url('/admin/dashboard')}}">
               <i data-feather="home"></i>
               <span> Dashboard </span>
               </a>
            </li>
            <li>
               <a @if($page='user') class="active" @endif href="{{url('/admin/userManagement/user/list')}}">
               <i class="fe-users"></i>
               <span> Users </span>
               </a>
            </li>
            <li>
               <a @if($page='user') class="active" @endif href="{{url('admin/sellerManagement/seller/list')}}">
               <i class="fa fa-shopping-cart"></i>
               <span> Shops </span>
               </a>
            </li> 
            <li>
               <a @if($page='category') class="active" @endif href="{{url('admin/categoryManagement/category/list')}}">
               <i class="fa fa-list-alt"></i>
               <span> Business Categories </span>
               </a>
            </li>
            <li>
               <a @if($page='product') class="active" @endif href="{{url('admin/productManagement/product/product-list')}}">
               <i class="fa fa-shopping-bag"></i>
               <span> Products </span>
               </a>
            </li>
            <li>
               <a @if($page='productCategory') class="active" @endif href="{{url('admin/productManagement/category/category-list')}}"> 
               <i class="fa fa-shopping-bag"></i>
               <span> Product Categories </span>
               </a>
            </li>
            <li>
               
               <a @if($page='order') class="active" @endif href="{{url('admin/orderManagement/order/order-list')}}"> 
               <i class="fa fa-truck"></i>
               <span> Orders </span>
               </a>
            </li>
           <!--  <li>
               <a @if($page='support') class="active" @endif  href="{{url('admin/admin-support')}}">
               <i class="fa fa-phone-square"></i>
               <span> Support </span>
               </a>
            </li>  -->
            <li>
               <a @if($page='payment') class="active" @endif href="{{url('admin/paymentManagement/payment/payment-list')}}">
               <i class="fa fa-credit-card"></i>
               <span> Payment Settings </span>
               </a>
            </li>
            <li>
               <a @if($page='commission') class="active" @endif href="{{url('admin/commissionManagement/commission/commission-list')}}">
               <i class="fa fa-cog"></i>
               <span> Commission Settings </span>
               </a>
            </li>

            <li>
               <a @if($page='cms') class="active" @endif href="{{url('admin/cms-page')}}">
               <i class="fe-file"></i>
               <span>Cms Pages </span>
               </a>
            </li>
            
            <li>
               <a @if($page='page') class="active" @endif href="{{url('admin/pages/list')}}">
               <i class="fe-file"></i>
               <span> Pages </span>
               </a>
            </li>
            <li class="dropdown show">
               <a class="btn btn-secondary " href="#sidebarprofile" role="button" id="" data-toggle="collapse" >
               <i data-feather="user-plus"></i>
               <span> Profile Setting <i class="mdi mdi-chevron-down"></i></span>
               </a>
               <div class="collapse" id="sidebarprofile">
                  <ul class="nav-second-level">
                     <a class="dropdown-item " @if($page='profile') class="active" active @endif  href="{{url('admin/update-profile')}}">Update My Profile</a>
                     <a class="dropdown-item"  @if($page='changePassword') class="active" active @endif  href="{{url('/admin/change-password')}}">Change Password</a>
                  </ul>
               </div>
            </li>
            <!-- <li>
               <a href="index.php">
               <i class="fe-log-out"></i>
               <span> Logout </span>
               </a>
            </li> -->
         </ul>
      </div>
      <div class="clearfix"></div>
   </div>
</div>