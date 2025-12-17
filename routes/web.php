<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;

// Super Admin Controller
use App\Http\Controllers\Super_Admin\{
    CompanyController,
    UserController,
    SuperAdminAuthController,
    SopController,
    SopquesansController,
    ChecklistController,
    VideoController,
    PaymentController,
    SubscriptionPlanController,
    CmsController,
    SettingController,
};

// Admin Controller
use App\Http\Controllers\Admin\{
    AdminAuthController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| All web routes for the application
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Supper Admin Routes
|--------------------------------------------------------------------------
| All admin related routes are grouped here
|--------------------------------------------------------------------------
*/
Route::prefix('super-admin')->name('super.admin.')->group(function () {

    // Auth Pages
    Route::get('/', [SuperAdminAuthController::class, 'index'])->name('index');
    Route::get('login', [SuperAdminAuthController::class, 'login'])->name('login');
    Route::post('login', [SuperAdminAuthController::class, 'postLogin'])->name('login.post');


    // Forgot & Reset Password
    Route::get('forget-password', [SuperAdminAuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [SuperAdminAuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [SuperAdminAuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [SuperAdminAuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    /*
    |--------------------------------------------------------------------------
    | Protected Super Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['super_admin'])->group(function () {
        Route::get('dashboard', [SuperAdminAuthController::class, 'adminDashboard'])->name('dashboard');
        Route::get('change-password', [SuperAdminAuthController::class, 'changePassword'])->name('change.password');
        Route::post('update-password', [SuperAdminAuthController::class, 'updatePassword'])->name('update.password');
        Route::get('logout', [SuperAdminAuthController::class, 'logout'])->name('logout');
        Route::get('profile', [SuperAdminAuthController::class, 'adminProfile'])->name('profile');
        Route::post('profile', [SuperAdminAuthController::class, 'updateAdminProfile'])->name('update.profile');


        // Master Route
        // Resource Management Routes (Variation, Tax, Item, Vendor, Customer)
        foreach (['company','user','sop','sopquesans','checklist','video','payment','subscriptionPlan','cms','setting'] as $resource) {
            Route::prefix($resource)->name("$resource.")->group(function () use ($resource) {
                $controller = "App\Http\Controllers\Super_Admin\\" . ucfirst($resource) . "Controller";
                Route::get('/', [$controller, 'index'])->name('index');
                Route::get('all', [$controller, 'getall'])->name('getall');
                Route::post('store', [$controller, 'store'])->name('store');
                Route::post('status', [$controller, 'status'])->name('status');
                Route::delete('delete/{id}', [$controller, 'destroy'])->name('destroy');
                Route::get('get/{id}', [$controller, 'get'])->name('get');
                Route::post('update', [$controller, 'update'])->name('update');
                if($resource === 'sop' || $resource === 'checklist' || $resource === 'video'){
                    Route::get('show/{id}', [$controller, 'show'])->name('show');
                }

                if($resource === 'sopquesans'){
                    Route::get('{id}/qa', [$controller, 'showQA'])->name('show.qa');
                }
            });
        }

    });

});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| All admin related routes are grouped here
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth Pages
    Route::get('/', [AdminAuthController::class, 'index'])->name('index');
    Route::get('login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('login', [AdminAuthController::class, 'postLogin'])->name('login.post');


    // Forgot & Reset Password
    Route::get('forget-password', [AdminAuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [AdminAuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [AdminAuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [AdminAuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'adminDashboard'])->name('dashboard');
        Route::get('change-password', [AdminAuthController::class, 'changePassword'])->name('change.password');
        Route::post('update-password', [AdminAuthController::class, 'updatePassword'])->name('update.password');
        Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('profile', [AdminAuthController::class, 'adminProfile'])->name('profile');
        Route::post('profile', [AdminAuthController::class, 'updateAdminProfile'])->name('update.profile');

    });

});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Frontend Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Add user-protected routes here

});
