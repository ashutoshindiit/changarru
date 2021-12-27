<div class="navbar-custom">
   <div class="container-fluid">
      <ul class="list-unstyled topnav-menu float-right mb-0">
         <li class="d-none d-lg-block">
            <form class="app-search">
               <div class="app-search-box dropdown">
                  <div class="input-group">
                     <input type="search" class="form-control" placeholder="Search..." id="top-search">
                     <div class="input-group-append">
                        <button class="btn" type="submit">
                        <i class="fe-search"></i>
                        </button>
                     </div>
                  </div>
               </div>
            </form>
         </li>
         <?php
             $adminDetail = Auth::guard('admin')->user();
         ?>
  
         <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <img  src="{{@$adminDetail['image']?asset('public/backend/assets/images/profile/'.$adminDetail['image']):asset('public/backend/assets/images/default.jpg')}}" alt="user-image" class="rounded-circle">
            <span class="pro-user-name ml-1">
            {{$adminDetail['full_name']}} <i class="mdi mdi-chevron-down"></i> 
            </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

               <a href="{{url('/admin/update-profile')}}" class="dropdown-item notify-item">
               <i class="fe-user"></i>
               <span>Profile</span>
               </a>
               <!-- item-->
               <a href="{{route('adminLogout')}}" class="dropdown-item notify-item">
               <i class="fe-log-out"></i>
               <span>Logout</span>
               </a>
            </div>
         </li>
      </ul>
      <!-- LOGO -->
      <div class="logo-box">
         <a href="index.php" class="logo logo-dark text-center">
         <span class="logo-sm logocus">
         <img  src="{{asset('public/backend/assets/images/logo-1.png')}}" alt="">
         </span>
         <span class="logo-lg logocus">
         <img src="{{asset('public/backend/assets/images/logo.png')}}" alt="">
         </span>
         </a>
         <a href="index.php" class="logo logo-light text-center">
         <span class="logo-sm logocus">
         <img src="{{asset('public/backend/assets/images/logo-s-m.png')}}" alt="">
         </span>
         <span class="logo-lg logocus">
         <img  src="{{asset('public/backend/assets/images/logo.png')}}" alt="">
         </span>
         </a>
      </div>
      <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
         <li>
            <button class="button-menu-mobile waves-effect waves-light">
            <i class="fe-menu"></i>
            </button>
         </li>
         <li>
            <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
               <div class="lines">
                  <span></span>
                  <span></span>
                  <span></span>
               </div>
            </a>
         </li>
      </ul>
      <div class="clearfix"></div>
   </div>
</div>