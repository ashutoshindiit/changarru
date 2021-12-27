<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [ApiController::class, 'seller_registration']);
Route::post('/resend-verification-code', [ApiController::class, 'resendVerificationCode']);
Route::post('/otp_verification', [ApiController::class, 'otp_verification']);

    Route::group(['middleware'=>'token_auth'],function(){

        Route::get('/get-buisness-detail', [ApiController::class, 'getSellerBuisnessDetail']);
        Route::post('/update-buisness-detail', [ApiController::class, 'updateSellerBuisnessDetail']);
        Route::get('/get-dashboard-detail', [ApiController::class, 'getDashboardDetail']);

        Route::get('/get-product-categories', [ApiController::class, 'getProductCategories']);
        Route::get('/get-product-categories-detail/{category_id}', [ApiController::class, 'getProductCategoriesDetail']);

        Route::post('/add-product-categories', [ApiController::class, 'addProductCategories']);
        Route::post('/edit-product-categories/{category_id}', [ApiController::class, 'editProductCategories']);
        Route::post('/delete-product-categories/{category_id}', [ApiController::class, 'deleteProductCategories']);

        Route::get('/get-products', [ApiController::class, 'getProducts']);
        Route::get('/get-productDetail/{product_id}', [ApiController::class, 'getProductDetail']);

        Route::post('/add-product', [ApiController::class, 'addProduct']);
        Route::post('/edit-product/{product_id}', [ApiController::class, 'editProduct']);
        Route::post('/delete-product/{product_id}', [ApiController::class, 'deleteProduct']);

        Route::get('/get-all-discount-coupon', [ApiController::class, 'getDiscountCoupon']);
        Route::post('/add-discount-coupon', [ApiController::class, 'addDiscountCoupon']);
        Route::post('/edit-discount-coupon/{discount_coupon_id}', [ApiController::class, 'editDiscountCoupon']);

        Route::post('/change-discount-coupon-status/{discount_coupon_id}', [ApiController::class, 'changeStatusDiscountCoupon']);
        Route::post('/delete-discount-coupon/{discount_coupon_id}', [ApiController::class, 'deleteDiscountCoupon']);

        Route::post('/add-additional-information', [ApiController::class, 'addAdditionalInformation']);
        Route::post('/edit-additional-information/{information_id}', [ApiController::class, 'editAdditionalInformation']);
        Route::post('/delete-additional-information/{information_id}', [ApiController::class, 'deleteAdditionalInformation']);

        // TermAndCondtion
        Route::get('/get-term-and-condtion', [ApiController::class, 'getTermAndCondtion']);
        Route::post('/add-term-and-condtion', [ApiController::class, 'addTermAndCondtion']);

        // PrivacyAndPolicy
        Route::get('/get-privacy-and-policy', [ApiController::class, 'getPrivacyAndPolicy']);
        Route::post('/add-privacy-and-policy', [ApiController::class, 'addPrivacyAndPolicy']);

        Route::get('/get-allOrder', [ApiController::class, 'getOrder']);
        Route::get('/get-OrderDetail/{orderId}', [ApiController::class, 'getOrderDetail']);
        Route::post('/accepted-order/{orderId}', [ApiController::class, 'acceptedOrder']);
        Route::post('/rejected-order/{orderId}', [ApiController::class, 'rejectedOrder']);

        //
        Route::post('/change-product-status/{product_id}', [ApiController::class, 'changeStatusProduct']);
        Route::post('/change-product-category-status/{category_id}', [ApiController::class, 'changeStatusCategory']);

        Route::post('/get-pendingOrder',   [ApiController::class, 'getPendingOrder']);
        Route::post('/get-shippedOrder',   [ApiController::class, 'getShippedOrder']);

        Route::post('/get-acceptedOrder',  [ApiController::class, 'getAcceptedOrder']);
        Route::get('/get-rejectedOrder',  [ApiController::class, 'getRejectedOrder']);
        Route::get('/get-cancelledOrder', [ApiController::class, 'getCancelledOrder']);
        Route::get('/get-deliveredOrder', [ApiController::class, 'getDeliveredOrder']);
        Route::post('/get-sellerCustomers', [ApiController::class, 'getSellerCustomer']);

        Route::get('/get-seller-extra-charge', [ApiController::class, 'getSellerExtraChargeList']);
        Route::post('/add-seller-extra-charge', [ApiController::class, 'addSellerExtraCharge']);

        // sellerGstcharge
        Route::get('/get-seller-gst-charge', [ApiController::class, 'getSellerGstChargeList']);
        Route::post('/add-seller-gst-charge', [ApiController::class, 'addSellerGstCharge']);

        Route::get('/get-seller-gst-charge', [ApiController::class, 'getSellerGstChargeList']);

        Route::get('/get-all-units', [ApiController::class, 'getAllUnits']);

        // QrCodeGenerate
        Route::get('/get-qrCodeGenerate', [ApiController::class, 'QrCodeGenerate']);

        //Change order status
        Route::post('/change-seller-app-status', [ApiController::class, 'changeSellerAppStatus']);
        
        Route::post('/search-product', [ApiController::class, 'searchProduct']);
        Route::post('/search-category', [ApiController::class, 'searchCategory']);
        Route::post('/search-order-number', [ApiController::class, 'searchOrderNumber']);

        Route::post('/life-time-filter', [ApiController::class, 'lifeTimeFilter']);

        //Extra Form
        Route::get('/get-store-setting', [ApiController::class, 'getStoreSetting']);
        Route::post('/add-store-setting', [ApiController::class, 'addStoreSetting']);        
        Route::post('/update-store-setting/{id}', [ApiController::class, 'updateStoreSetting']);        
        Route::post('/delete-store-setting/{id}', [ApiController::class, 'deleteStoreSetting']);        


        Route::post('/sign-out', [ApiController::class, 'logout']);
    });