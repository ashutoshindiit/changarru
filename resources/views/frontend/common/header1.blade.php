<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Changarru</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" src="{{asset('public/frontend/favicon.ico')}}">
      <!-- CSS 
         ========================= -->
      <!--bootstrap min css-->
     <link href="{{ url('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ url('frontend/assets/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ url('frontend/assets/css/slick.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ url('frontend/assets/css/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ url('frontend/assets/css/font.awesome.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ url('frontend/assets/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ url('frontend/assets/css/linearicons.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ url('frontend/assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ url('frontend/assets/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ url('frontend/assets/css/slinky.menu.css') }}" rel="stylesheet" type="text/css" />
      <!--plugins css-->
     <link href="{{ url('frontend/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />

      <!-- <link rel="stylesheet" href="assets/css/plugins.css"> -->
      <!-- Main Style CSS -->
     <link href="{{ url('frontend/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

      <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
      <!-- Responisve CSS -->
     <link href="{{ url('frontend/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

      <!-- <link rel="stylesheet" href="assets/css/responsive.css"> -->
      <!--modernizr min js here-->
     <link href="{{ url('frontend/js/vendor/modernizr-3.7.1.min.js') }}" rel="stylesheet" type="text/css" />
      
      <!-- <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script> -->
   </head>
   <body>
      <!--header area start-->
      <header>
         <div class="main_header">
            <div class="header_middle sticky-header">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-lg-2 col-md-3 col-sm-3 col-4">
                        <div class="logo">
                          
                           <a href="{{url('/')}}"><img src="{{asset('frontend/assets/img/logo/logo.png')}}" alt="" /></a>
                        </div>
                     </div>
                     <div class="col-lg-10 col-md-6 col-sm-7 col-8">
                        <div class="header_right_info">
                           <div class="search_container mobail_s_none">
                             <form method="get" action="{{url('/'.$slug)}}" id="rev_retk_form_id"> @csrf
                                        <div class="hover_category">
                                            <select class="select_option" name="category_id" id="categori2" type="text" value="">
                                                <option selected disabled>Select Category</option> 
                                                @if(isset($allCategories) && !empty($allCategories)) 
                                                    @foreach($allCategories as $name)
                                                        <option value="{{@$name['id']}}">{{@$name['name']}}</option>
                                                    @endforeach
                                                @endif 
                                            </select>
                                            <input type="hidden" name="slug" value="{{$slug}}"> </div>
                                        <div class="search_box">
                                            <input name="product_name" value="" placeholder="Search product..." type="text">
                                            <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                                        </div>
                                    </form>
                           </div>
                           <div class="header_account_area">
                              <div class="header_account_list  mini_cart_wrapper">
                                 <a href="javascript:void(0)"><span class="lnr lnr-cart"></span><span class="item_count">2</span></a>
                                 <!--mini cart-->
                                 <div class="mini_cart">
                                    <div class="cart_gallery">
                                       <div class="cart_close">
                                          <div class="cart_text">
                                             <h3>cart</h3>
                                          </div>
                                          <div class="mini_cart_close">
                                             <a href="javascript:void(0)"><i class="icon-x"></i></a>
                                          </div>
                                       </div>
                                       <div class="cart_item">
                                          <div class="cart_img">
                                             <a href="#"><img src="assets/img/s-product/product.jpg" alt=""></a>
                                          </div>
                                          <div class="cart_info">
                                             <a href="#">Primis In Faucibus</a>
                                             <p>1 x <span> $65.00 </span></p>
                                          </div>
                                          <div class="cart_remove">
                                             <a href="#"><i class="icon-x"></i></a>
                                          </div>
                                       </div>
                                       <div class="cart_item">
                                          <div class="cart_img">
                                             <a href="#"><img src="assets/img/s-product/product2.jpg" alt=""></a>
                                          </div>
                                          <div class="cart_info">
                                             <a href="#">Letraset Sheets</a>
                                             <p>1 x <span> $60.00 </span></p>
                                          </div>
                                          <div class="cart_remove">
                                             <a href="#"><i class="icon-x"></i></a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="mini_cart_table">
                                       <div class="cart_table_border">
                                          <div class="cart_total">
                                             <span>Sub total:</span>
                                             <span class="price">$125.00</span>
                                          </div>
                                          <div class="cart_total mt-10">
                                             <span>total:</span>
                                             <span class="price">$125.00</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="mini_cart_footer">
                                       <div class="cart_button">
                                          <a href="cart.php"><i class="fa fa-shopping-cart"></i> View cart</a>
                                       </div>
                                       <div class="cart_button">
                                          <a href="checkout.php"><i class="fa fa-sign-in"></i> Checkout</a>
                                       </div>
                                    </div>
                                 </div>
                                 <!--mini cart end-->
                              </div>

                              <div class="header_account_list register">
                                 <div class="sidebarFilter">
                                    <a href="javascript:void(0)" class="filterBtn"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!--header area end-->