<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Business\BankDetailsController;
use App\Http\Controllers\Business\ProductController;
use Illuminate\Support\Facades\View;
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

Route::prefix('v1/')->group(function(){
    Route::get('users/get-all-user-type', [UserController::class, 'get_all_user_type']);
    Route::post('auth/get-otp', [AuthController::class, 'send_otp']);


    Route::post('auth/login', [AuthController::class, 'login']);

    Route::post('auth/mobile-number', [AuthController::class, 'mobile_number']);
    Route::post('auth/mobile-number-verify', [AuthController::class, 'mobile_number_verify']);

    Route::post('auth/aadhar-number', [AuthController::class, 'aadhar_number']);
    Route::post('auth/aadhar-verify', [AuthController::class, 'aadhar_verification']);

    Route::post('auth/email-otp', [AuthController::class, 'email_otp']);
    Route::post('auth/email-verify', [AuthController::class, 'email_otp_verification']);

    Route::post('auth/verify-otp', [AuthController::class, 'verify_otp']);
    Route::post('business/registration', [AuthController::class, 'business_registration']);
    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
  // Route::middleware( [ 'auth:api' ] )->group( function(){
        Route::prefix('/business')->group(function(){
            Route::get('/get-categories', [CategoryController::class, 'get_all_categories']);
            Route::get('/get-subcategories', [CategoryController::class, 'get_all_subcategories']);     
            // Route::post('/aadhar-number', [AuthController::class, 'aadhar_number']);
            // Route::post('/aadhar-verify', [AuthController::class, 'aadhar_verification']);
            Route::post('/account-details', [AuthController::class, 'add_business_bank_details']);
            Route::post('/add-product', [ProductController::class, 'add_product']);
            Route::post('/update-product', [ProductController::class, 'update_product']);
            Route::post('/delete-product', [ProductController::class, 'delete_product']);
            Route::get('/get-all-product-details', [ProductController::class, 'get_all_product_details']);
            Route::get('/get-product-details/{id}', [ProductController::class, 'get_product_details']);
            Route::get('/all-products-in-travel', [ProductController::class, 'get_all_products_in_travel']);
            Route::get('/all-products-in-fashion', [ProductController::class, 'get_all_products_in_fasion']);
            Route::get('/all-products-in-lifestyle', [ProductController::class, 'get_all_products_in_lifestyle']);
            Route::get('/all-products-in-food', [ProductController::class, 'get_all_products_in_food']);
           
        });
   // });
});