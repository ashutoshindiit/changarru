 <?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\CmsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeatureController;



/*

|--------------------------------------------------------------------------

| Web Routes 

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/
	Route::any('/', [CmsController::class, 'index']);
    // Route::any('/home/index', [CmsController::class, 'index']);
    Route::any('/about-us', [CmsController::class, 'getAboutUs']);
    Route::any('/blog', [CmsController::class, 'getBlog']);
    Route::any('/blog-details/{slug_id}', [CmsController::class, 'getBlogDetail']);
    
	Route::any('/blog-category-wise-detail', [CmsController::class, 'getBlogCategoryWiseDetail']);
	Route::any('/blog-search', [CmsController::class, 'getBlogSearch']);
	
    Route::any('/faq', [CmsController::class, 'getFaq']);
    Route::any('/contact-us', [CmsController::class, 'getContactUs']);
    Route::any('/page/{slug}', [CmsController::class, 'getPageSlug']);

    Route::any('/store-directory', [CmsController::class, 'getStoreDirectory']);
    Route::any('/stores/{buisnessCategoryId}', [CmsController::class, 'getStore']);
      

	Route::group(['middleware'=>'GuestAuth'],function(){

		Route::any('/{slug?}', [HomeController::class, 'dashboard']);

		Route::any('/home/category-wise/product', [HomeController::class, 'getCategoryWiseDetail']);

		Route::any('/{slug}/product-details/{product_slug}', [HomeController::class, 'productDetail']);

		Route::any('/{slug}/cart/add-Product', [HomeController::class, 'addProductAsCart']);

		Route::any('/{slug}/cart-from-description/add-Product', [HomeController::class, 'addProductDescriptiopnCart']);

		Route::any('/{slug}/delete-cart-product/{productCartId}', [HomeController::class, 'deleteCartItem']);

		Route::any('/{slug}/register-with-number', [HomeController::class, 'registerWithMobile']);

		Route::any('/{slug}/otp-verification', [HomeController::class, 'otpVerification']);



		Route::post('/{slug}/without-login-confirm-order', [HomeController::class, 'withoutLoginConfirmOrder']);

		Route::any('/{slug}/privacy-policy', [HomeController::class, 'getPrivacyPolicy']);

		Route::any('/{slug}/term-and-condtion', [HomeController::class, 'getTermAndCondtion']);



	});

		Route::any('/{slug}/view-cart-detail', [HomeController::class, 'cartDetail']);

		Route::any('/{slug}/update-cart-detail', [HomeController::class, 'updateCartDetail']);

		Route::any('/{slug}/couponApply', [HomeController::class, 'checkCouponApply']);

		Route::any('/{slug}/cart-checkout', [HomeController::class, 'cartCheckout']);

		Route::group(['middleware'=>'CheckUserAuth'],function(){
		// After Login Routes

		Route::any('/{slug}/my-orders', [HomeController::class, 'myOrders']);

		Route::any('/{slug}/render-my-orders', [HomeController::class, 'renderMyOrder']);



		Route::any('/{slug}/my-orders/details/{orderId}', [HomeController::class, 'myOrderDetail']);

		Route::any('/{slug}/payment-method', [HomeController::class, 'paymentMethod']);



		Route::any('/{slug}/my-addresses', [HomeController::class, 'myAddresses']);

		Route::any('/{slug}/add-my-addresses', [HomeController::class, 'addMyAddress']);

		Route::any('/{slug}/update-my-addresses', [HomeController::class, 'updateMyAddress']);

		Route::any('/{slug}/delete-my-addresses', [HomeController::class, 'deleteMyAddress']);

		Route::any('/{slug}/default-my-addresses', [HomeController::class, 'setDefualtAddress']);

		Route::any('/{slug}/support', [HomeController::class, 'getSupport']);

		// myOrder	

		Route::any('/{slug}/order-create', [OrderController::class, 'createOrder']);

		Route::any('/{slug}/order-completed', [OrderController::class, 'orderCompleted']);

		// order-completed

		Route::any('/{slug}/logout', [HomeController::class, 'logout']);

	});

		Route::any('/admin/login', [AdminController::class, 'loginAdmin']);

		//Admin

		Route::group(['prefix'=>'admin'],function(){

			Route::any('/login', [AdminController::class, 'loginAdmin']);

			Route::any('/forgot-password', [AdminController::class, 'forgotPassword']);

			// Route::any('/change-password', [AdminController::class, 'changePassword']);

		});

		//Admin after login

		Route::group(['middleware'=>'admin','prefix'=>'admin'],function(){

			Route::any('/dashboard', [AdminController::class, 'dashboard']);

			// Route::any('/user', [AdminController::class, 'getUser']);

			Route::any('/userManagement/user/list', [AdminController::class, 'userList']);

			Route::any('/userManagement/user/delete/{id}', [AdminController::class, 'userDelete']);
			Route::any('/userManagement/user/restore/{id}', [AdminController::class, 'userRestored']);

			Route::any('/userManagement/userAddress/list/{id}', [AdminController::class, 'userAddressList']);

			Route::any('/userManagement/userAddress/delete/{id}', [AdminController::class, 'userAddressDelete']);

			Route::any('/sellerManagement/seller/list', [AdminController::class, 'shopList']);

			Route::any('/sellerManagement/seller/update/{id}', [AdminController::class, 'updateShop']);

			Route::any('/sellerManagement/seller/delete/{id}', [AdminController::class, 'shopDelete']);

			Route::any('/categoryManagement/category/list', [AdminController::class, 'categoryList']);

			Route::any('/categoryManagement/category/add', [AdminController::class, 'addCategory']);

			Route::any('/categoryManagement/category/update/{id}', [AdminController::class, 'updateCategory']);

			Route::any('/categoryManagement/category/delete/{id}', [AdminController::class, 'categoryDelete']);



			Route::any('/pages/list', [PageController::class, 'getPagesList']);

			Route::any('/pages/add-page', [PageController::class, 'addPage']);

			Route::any('/pages/update/{id}', [PageController::class, 'editPage']);

			Route::any('/pages/delete/{pageId}', [PageController::class, 'pageDelete']);

		
			Route::any('/edit-terms', [PageController::class, 'termsCondtion']);
			Route::any('/edit-privacy', [PageController::class, 'privacyPolicy']);
			Route::any('/admin-support', [AdminController::class, 'getSupportList']);
			Route::any('/support-detail/{supportId}', [AdminController::class, 'supportDetail']);
			Route::any('/support/delete/{supportId}', [AdminController::class, 'supportDelete']);

			// ProductController

			Route::any('/productManagement/product/product-list', [ProductController::class, 'productList']);

			Route::any('/productManagement/product/add-product', [ProductController::class, 'addProduct']);

			Route::any('/productManagement/product/render-category', [ProductController::class, 'renderCategory']);

			Route::any('/productManagement/product/edit-product/{id}', [ProductController::class, 'editProduct']);

			Route::any('/productManagement/product/render-category-for-edit', [ProductController::class, 'renderCategoryForEditProduct']);

			Route::any('/productManagement/product/delete-product/{id}', [ProductController::class, 'productDelete']);

			Route::any('/productManagement/product/image/delete/{id}', [ProductController::class, 'deleteProductImage']);

			// ProductController => category

			Route::any('/productManagement/category/category-list', [ProductController::class, 'productCategoryList']);

			Route::any('/productManagement/category/add-category', [ProductController::class, 'addProductCategory']);

			Route::any('/productManagement/category/edit-category/{id}', [ProductController::class, 'editProductCategory']);

			Route::any('/productManagement/category/delete-category/{id}', [ProductController::class, 'deleteProductCategory']);

			// allOrder

			Route::any('/orderManagement/order/order-list', [PaymentController::class, 'allOrder']);
			Route::any('/orderManagement/order/view-order/{id}', [PaymentController::class, 'viewOrder']);

			//Blog Controller
			Route::get('/add-blog/{id?}',[BlogController::class,'add']);
			Route::get('/edit-blog/{id?}',[BlogController::class,'add']);
			Route::post('/add-blog/{id?}', [BlogController::class,'add']);
			Route::get('/blogs', [BlogController::class, 'index']);    
			Route::post('delete-blog/{id}', [BlogController::class, 'delete']);
			
			Route::any('/add-Category/{id?}',[BlogController::class,'addCategory']);
			Route::get('/edit-Category/{id?}',[BlogController::class,'addCategory']);
			Route::get('blogs-categories', [BlogController::class, 'indexCategory']);
			Route::any('delete-blogsCategories/{id}', [BlogController::class, 'deleteCategory']);
			
			//Faq Controller
			Route::get('/add-faq/{id?}',[FaqController::class,'add']);
			Route::get('/edit-faq/{id?}',[FaqController::class,'add']);
			Route::post('/add-faq/{id?}', [FaqController::class,'add']);
			Route::get('/faqs', [FaqController::class, 'indexFaq']);
			Route::post('delete-faq/{id}', [FaqController::class, 'deleteFaq']);

			// paymentSetting
			Route::any('/paymentManagement/payment/payment-list', [PaymentController::class, 'paymentSetting']);
			// commission
			Route::any('/commissionManagement/commission/commission-list', [PaymentController::class, 'updateCommissionSettings']);

			//Contact Us Query
			Route::any('/contact-us', [AdminController::class, 'contactUsQueryList']);
        	Route::any('/contactUs/query/reply', [AdminController::class, 'contactUsQueryReply']);	
			
			//CMS Page
			Route::any('/cms-page', [AdminController::class, 'cmsPageList']);
			Route::any('/edit-about-us-page', [AdminController::class, 'editAboutUsPage']);
			Route::any('/update-profile', [AdminController::class, 'admin_profile']);
			Route::any('/change-password', [AdminController::class, 'changePasswordAdmin']);
			Route::any('/signout', [AdminController::class, 'adminlogout'])->name('adminLogout');

			// FeatureController
	        Route::any('/add-changarru-feature',[FeatureController::class,'add']);
	        Route::any('/add-changarru-feature/{id?}',[FeatureController::class,'add']);
	        Route::get('/changarru-feature', [FeatureController::class, 'index']);
	        Route::any('/delete-changarru-feature/{id}', [FeatureController::class, 'delete']);

    		//Testimonial
            Route::any('/add-changarru-testimonial/{id?}',[FeatureController::class,'addTestimonial']);
            Route::get('/changarru-testimonial', [FeatureController::class, 'indexTestimonial']);
            Route::any('/delete-changarru-testimonial/{id}', [FeatureController::class, 'deleteTestimonial']);

			// HomepageInformation
            Route::any('/update-homepage-information', [FeatureController::class, 'updateHomepageInformation']);

		});

		Route::post('/ajax/shipping_quotes_get',  [HomeController::class, 'getShippingQuotes']); 
		//define('defaultAdminImagePath',asset('public/admin/images/'));