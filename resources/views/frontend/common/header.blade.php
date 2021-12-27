<!doctype html>

<html class="no-js" lang="en">

<style type="text/css">
    .error{
        color: red;
    }    
</style>


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

    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <link href="{{ url('frontend/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ url('frontend/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ url('frontend/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- <link href="{{ url('frontend/assets/js/vendor/modernizr-3.7.1.min.js') }}" rel="stylesheet" type="text/css" /> -->

    <link rel="stylesheet" href="{{asset('frontend/assets/css/toastr.css')}}" type="text/css" media="all" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />

</head>



<body class="Site">

    <!--header area start-->

    <header>

        <div class="main_header">

            <div class="header_middle sticky-header">

                <div class="container">

                    <div class="row align-items-center">

                        <div class="col-lg-2 col-md-3 col-sm-3 col-4">

                            <div class="logo">

                                <a href="{{url('/'.$slug)}}"><img src="{{asset('frontend/assets/img/logo/logo.png')}}" alt="" /></a>

                            </div>

                        </div>

                        <div class="col-lg-10 col-md-6 col-sm-7 col-8">

                            <div class="header_right_info">

                                <div class="search_container mobail_s_none">

                                    <form method="get" action="{{url('/'.$slug)}}" id="rev_retk_form_id"> 

                                        <div class="hover_category">

                                            <select class="select_option" name="category_id" id="categori2" type="text" value="">

                                                <option selected disabled>Select Category</option> 

                                                @if(isset($allCategories) && !empty($allCategories)) 

                                                    @foreach($allCategories as $name)

                                                        <option value="{{@$name['id']}}" <?php if(isset($_GET['category_id'])){if($_GET['category_id']==$name['id']){ echo 'selected';}}?> >{{@$name['name']}}</option>

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

                                <div class="header_account_area ">

                                    <div class="header_account_list register">

                                        <ul>

                                            @if (Auth::check())

                                                <li><a href="{{url('/'.$slug.'/my-orders')}}" class="iFont"><span class="lnr lnr-user"></span>+ {{Auth::user()->isd_code}}-{{Auth::user()->mobile_number}}</a></li>

                                            @else  

                                                <li><a  class="iFont" id="reigsterModelOpen" ><span class="lnr lnr-user"></span> Account</a></li>    

                                            @endif



                                        </ul>

                                    </div>

                                    <?php   

                                        if (Auth::check()) {
                                            $userId  = Auth::user()->id;
                                        }else{
                                            $userId   = @$_COOKIE['guestId'];
                                        }

                                        $discountPriceSession        = Session::get('discount_price');

                                        $discountTypeSession         =  Session::get('discount_type');

                                        //Below for flat price case only

                                        $discounted_AmountSession    =  Session::get('discounted_Amount');

                                        
                                        if (Auth::check()) {

                                            $userId  = Auth::user()->id;

                                            $item_count = App\Models\ProductCart::where('user_id',$userId)
                                                                                ->get()
                                                                                ->count();   

                                            $pluckProduct = App\Models\ProductCart::where('user_id',$userId)->pluck('product_id');

                                            $sellerProduct = App\Models\SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')->whereIn('id',$pluckProduct)
                                                               ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                                                               ->get();

                                            $sumProductPrice = App\Models\ProductCart::where('user_id',$userId)->sum('total_price');                                           

                                            // dd($sumProductPrice);           

                                         }else{

                                            $userId  = @$_COOKIE['guestId'];

                                            $item_count = App\Models\ProductCart::where('user_id',$userId)                                  ->count();

                                            $pluckProduct = App\Models\ProductCart::where('user_id',$userId)->pluck('product_id');

                                            $sellerProduct = App\Models\SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')->whereIn('id',$pluckProduct)

                                                            ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory')

                                                            ->get();

                                            $sumProductPrice = App\Models\ProductCart::where('user_id',$userId)->sum('total_price');     

                                            // dd($sumProductPrice);

                                         }

                                      ?>

                                        <div class="header_account_list  mini_cart_wrapper"> 

                                            <a href="javascript:void(0)">

                                                <span class="lnr lnr-cart"></span>

                                                <span class="item_count cart-count">{{@$item_count}}</span>

                                            </a>

                                            <!--mini cart-->

                                            <div class="mini_cart cartDetailHeaderRenderData">

                                                @include('frontend.element.headerElement')

                                            </div>

                                        </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="search_container searchBox showOnIndex deskTop_s_none">

                <form action="#">

                    <div class="hover_category">

                        <select class="select_option" name="select" id="categori2">

                            <option selected value="1">Select a categories</option>

                            <option value="2">Accessories</option>

                            <option value="3">Accessories & More</option>

                            <option value="4">Butters & Eggs</option>

                            <option value="5">Camera & Video </option>

                            <option value="6">Mornitors</option>

                            <option value="7">Tablets</option>

                            <option value="8">Laptops</option>

                            <option value="9">Handbags</option>

                            <option value="10">Headphone & Speaker</option>

                            <option value="11">Herbs & botanicals</option>

                            <option value="12">Vegetables</option>

                            <option value="13">Shop</option>

                            <option value="14">Laptops & Desktops</option>

                            <option value="15">Watchs</option>

                            <option value="16">Electronic</option>

                        </select>

                    </div>

                    <div class="search_box">

                        <input placeholder="Search product..." type="text">

                        <button type="submit"><span class="lnr lnr-magnifier"></span></button>

                    </div>

                </form>

            </div>

        </div>

    </header>

    <!--header area end-->