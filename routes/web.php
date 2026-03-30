<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    HomeController,
    AuthController,
    SopController as WebSopController,
    ChecklistController as WebChecklistController,
    VideoController as WebVideoController,
    VideoResultController as WebVideoResultController,
    SopResultController as WebSopResultController,
    ChecklistResultController as WebChecklistResultController
};

// Super Admin Controller
use App\Http\Controllers\Super_Admin\{
    CompanyController,
    UserController,
    SuperAdminAuthController,
    SopController,
    ChecklistController,
    VideoController,
    PaymentController,
    SubscriptionPlanController,
    CmsController,
    SettingController,
    DepartmentController as SuperAdminDepartmentController,
};

// Admin Controller
use App\Http\Controllers\Admin\{
    AdminAuthController,
    SubscriptionController,
    DepartmentController,
    UserController as AdminUserController,
    SopController as AdminSopController,
    SopQuesAnsController as AdminSopQuesAnsController,
    ChecklistController as AdminChecklistController,
    ChecklistQuesAnsController as AdminChecklistQuesAnsController,
    VideoController as AdminVideoController,
    VideoQuesAnsController as AdminVideoQuesAnsController,
    SopResultController as AdminSopResultController,
    VideoResultController as AdminVideoResultController,
    ChecklistResultController as AdminChecklistResultController
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
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about.us');
Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/plan', [HomeController::class, 'plan'])->name('plan');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

/*
|--------------------------------------------------------------------------
| Supper Admin Routes
|--------------------------------------------------------------------------
| All admin related routes are grouped here
|--------------------------------------------------------------------------
*/
Route::prefix('master')->name('super.admin.')->group(function () {

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
        foreach (['company','user','sop','checklist','video','payment','subscriptionPlan','cms','setting'] as $resource) {
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
                    Route::get('{id}/qa', [$controller, 'showQA'])->name('show.qa');
                }
                if($resource === 'sop'){
                    Route::get('view/{id}', [$controller, 'view'])->name('view');
                }
            });
        }

        /* Departments */
            Route::prefix('departments')->name('departments.')->controller(SuperAdminDepartmentController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('getall', 'getall')->name('getall');
            });

    });

});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
// Route::prefix('admin')
//     ->name('admin.')
//     ->controller(AdminAuthController::class)
//     ->group(function () {

//         /* Auth */
//         Route::get('/', 'index')->name('index');
//         Route::get('login', 'login')->name('login');
//         Route::post('login', 'postLogin')->name('login.post');

//         /* Password */
//         Route::get('forget-password', 'showForgetPasswordForm')->name('forget.password.get');
//         Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
//         Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
//         Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');

//         /*
//         |--------------------------------------------------------------------------
//         | Protected Admin
//         |--------------------------------------------------------------------------
//         */
//         Route::middleware('admin')->group(function () {

//             Route::get('dashboard', 'adminDashboard')->name('dashboard');
//             Route::get('change-password', 'changePassword')->name('change.password');
//             Route::post('update-password', 'updatePassword')->name('update.password');
//             Route::get('logout', 'logout')->name('logout');
//             Route::get('profile', 'adminProfile')->name('profile');
//             Route::post('profile', 'updateAdminProfile')->name('update.profile');

//             Route::get('subscription', [SubscriptionController::class, 'adminSubscription'])->name('subscription');
//             Route::post('/subscription/buy/{plan}', [SubscriptionController::class, 'buy'])->name('subscription.buy');

//             /* Departments */
//             Route::prefix('departments')->name('departments.')->controller(DepartmentController::class)->group(function () {
//                 Route::get('/', 'index')->name('index');
//                 Route::get('getall', 'getall')->name('getall');
//                 Route::post('store', 'store')->name('store');
//                 Route::get('get/{id}', 'get')->name('get');
//                 Route::post('update', 'update')->name('update');
//                 Route::post('status', 'status')->name('status');
//                 Route::delete('delete/{id}', 'destroy')->name('delete');
//                 Route::post('bulk-delete', 'bulkDelete')->name('bulkDelete');
//                 Route::post('bulk-status', 'bulkStatus')->name('bulkStatus');
//             });

//             /* Users */
//             Route::prefix('users')->name('user.')->controller(AdminUserController::class)->group(function () {
//                 Route::get('/', 'index')->name('index');
//                 Route::get('getall', 'getall')->name('getall');
//                 Route::post('store', 'store')->name('store');
//                 Route::get('get/{id}', 'get')->name('get');
//                 Route::post('update', 'update')->name('update');
//                 Route::post('status', 'status')->name('status');
//                 Route::delete('delete/{id}', 'destroy')->name('delete');
//                 Route::post('bulk-delete', 'bulkDelete')->name('bulkDelete');
//                 Route::post('bulk-status', 'bulkStatus')->name('bulkStatus');
//             });

//             /* Sops */
//             Route::prefix('sops')->name('sop.')->controller(AdminSopController::class)->group(function () {
//                 Route::get('/', 'index')->name('index');
//                 Route::get('create', 'create')->name('create');
//                 Route::post('store', 'store')->name('store');

//                 Route::get('/{id}/edit','edit')->name('edit');
//                 Route::put('/{id}', 'update')->name('update');
//                 Route::delete('/{id}', 'destroy')->name('destroy');
//             });


//             Route::prefix('sops')->name('sop.')->controller(AdminSopQuesAnsController::class)->group(function () {
//                 /* ================= SOP Q&A ================= */
//                 Route::get('/{id}/qa/create','create')->name('qa.create');
//                 Route::post('/qa/store', 'store')->name('qa.store');
//             });

//             /* Checklists */
//             Route::prefix('checklists')->name('checklist.')->controller(AdminChecklistController::class)->group(function () {
//                 Route::get('/', 'index')->name('index');
//                 Route::get('create', 'create')->name('create');
//                 Route::post('store', 'store')->name('store');

//                 Route::get('/{id}/edit','edit')->name('edit');
//                 Route::put('/{id}', 'update')->name('update');
//                 Route::delete('/{id}', 'destroy')->name('destroy');
//             });

//             /* Videos */
//             Route::prefix('videos')->name('video.')->controller(AdminVideoController::class)->group(function () {
//                 Route::get('/', 'index')->name('index');
//                 Route::get('create', 'create')->name('create');
//                 Route::post('store', 'store')->name('store');

//                 Route::get('/{id}/edit','edit')->name('edit');
//                 Route::put('/{id}', 'update')->name('update');
//                 Route::delete('/{id}', 'destroy')->name('destroy');
//             });

//             Route::prefix('videos')->name('video.')->controller(AdminVideoQuesAnsController::class)->group(function () {
//                 /* ================= Video Q&A ================= */
//                 Route::get('/{id}/qa/create','create')->name('qa.create');
//                 Route::post('/qa/store', 'store')->name('qa.store');
//             });


//             Route::prefix('sop-results')->name('sop.result.')->controller(AdminSopResultController::class)->group(function () {
//                 /* ================= SOP Results ================= */
//                 Route::get('/','index')->name('index');
//                 Route::get('/{id}/view','view')->name('view');
//             });

//             Route::prefix('video-results')->name('video.result.')->controller(AdminVideoResultController::class)->group(function () {
//                 /* ================= Video Results ================= */
//                 Route::get('/','index')->name('index');
//                 Route::get('/{id}/view','view')->name('view');
//             });
//         });
// });


Route::prefix('company')
    ->name('company.')
    ->controller(AdminAuthController::class)
    ->group(function () {

        /* ================= AUTH ================= */
        Route::get('/', 'index')->name('index');
        Route::get('login', 'login')->name('login');
        Route::post('login', 'postLogin')->name('login.post');

        /* ================= PASSWORD ================= */
        Route::get('forget-password', 'showForgetPasswordForm')->name('forget.password.get');
        Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
        Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
        Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');

        /*
        |--------------------------------------------------------------------------
        | ADMIN AUTH PROTECTED
        |--------------------------------------------------------------------------
        */
        Route::middleware('admin')->group(function () {

            /* ===== ALLOWED WITHOUT SUBSCRIPTION ===== */
            Route::get('dashboard', 'adminDashboard')->name('dashboard');
            Route::get('change-password', 'changePassword')->name('change.password');
            Route::post('update-password', 'updatePassword')->name('update.password');
            Route::get('logout', 'logout')->name('logout');
            Route::get('profile', 'adminProfile')->name('profile');
            Route::post('profile', 'updateAdminProfile')->name('update.profile');

            /* ===== SUBSCRIPTION (NO CHECK) ===== */
            Route::get('subscription', [SubscriptionController::class, 'adminSubscription'])->name('subscription');
            Route::post('subscription/buy/{plan}', [SubscriptionController::class, 'buy'])->name('subscription.buy');
            Route::post('subscription/add-users/{subscription}', [SubscriptionController::class, 'addUsers'])->name('subscription.add.users');


            /*
            |--------------------------------------------------------------------------
            | SUBSCRIPTION REQUIRED (IMPORTANT)
            |--------------------------------------------------------------------------
            */
            Route::middleware('subscription')->group(function () {

                /* ================= DEPARTMENTS ================= */
                Route::prefix('departments')->name('departments.')
                    ->controller(DepartmentController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('getall', 'getall')->name('getall');
                        Route::post('store', 'store')->name('store');
                        Route::get('get/{id}', 'get')->name('get');
                        Route::post('update', 'update')->name('update');
                        Route::post('status', 'status')->name('status');
                        Route::delete('delete/{id}', 'destroy')->name('delete');
                        Route::post('bulk-delete', 'bulkDelete')->name('bulkDelete');
                        Route::post('bulk-status', 'bulkStatus')->name('bulkStatus');
                    });

                /* ================= USERS ================= */
                Route::prefix('users')->name('user.')
                    ->controller(AdminUserController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('getall', 'getall')->name('getall');
                        Route::post('store', 'store')->name('store');
                        Route::get('get/{id}', 'get')->name('get');
                        Route::post('update', 'update')->name('update');
                        Route::post('status', 'status')->name('status');
                        Route::delete('delete/{id}', 'destroy')->name('delete');
                        Route::post('bulk-delete', 'bulkDelete')->name('bulkDelete');
                        Route::post('bulk-status', 'bulkStatus')->name('bulkStatus');
                    });

                /* ================= SOP ================= */
                Route::prefix('sops')->name('sop.')
                    ->controller(AdminSopController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('create', 'create')->name('create');
                        Route::get('filter', 'filter')->name('filter');
                        Route::post('store', 'store')->name('store');
                        Route::get('{id}/edit', 'edit')->name('edit');
                        Route::put('{id}', 'update')->name('update');
                        Route::delete('{id}', 'destroy')->name('destroy');
                        Route::get('view/{id}', 'view')->name('view');
                    });

                Route::prefix('sops')->name('sop.')
                    ->controller(AdminSopQuesAnsController::class)
                    ->group(function () {
                        Route::get('{id}/qa/create', 'create')->name('qa.create');
                        Route::post('qa/store', 'store')->name('qa.store');
                    });

                /* ================= CHECKLIST ================= */
                Route::prefix('checklists')->name('checklist.')
                    ->controller(AdminChecklistController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('create', 'create')->name('create');
                        Route::post('store', 'store')->name('store');
                        Route::get('{id}/edit', 'edit')->name('edit');
                        Route::put('{id}', 'update')->name('update');
                        Route::delete('{id}', 'destroy')->name('destroy');
                        Route::get('filter', 'filter')->name('filter');
                        Route::get('view/{id}', 'view')->name('view');
                    });

                Route::prefix('checklists')->name('checklist.')
                    ->controller(AdminChecklistQuesAnsController::class)
                    ->group(function () {
                        Route::get('{id}/qa/create', 'create')->name('qa.create');
                        Route::post('qa/store', 'store')->name('qa.store');
                    });

                /* ================= VIDEOS ================= */
                Route::prefix('videos')->name('video.')
                    ->controller(AdminVideoController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('create', 'create')->name('create');
                        Route::post('store', 'store')->name('store');
                        Route::get('{id}/edit', 'edit')->name('edit');
                        Route::put('{id}', 'update')->name('update');
                        Route::delete('{id}', 'destroy')->name('destroy');
                        Route::get('filter', 'filter')->name('filter');
                    });

                Route::prefix('videos')->name('video.')
                    ->controller(AdminVideoQuesAnsController::class)
                    ->group(function () {
                        Route::get('{id}/qa/create', 'create')->name('qa.create');
                        Route::post('qa/store', 'store')->name('qa.store');
                    });

                /* ================= RESULTS ================= */
                Route::prefix('sop-results')->name('sop.result.')
                    ->controller(AdminSopResultController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('{id}/view', 'view')->name('view');
                    });

                Route::prefix('video-results')->name('video.result.')
                    ->controller(AdminVideoResultController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('{id}/view', 'view')->name('view');
                    });

                Route::prefix('checklist-results')->name('checklist.result.')
                    ->controller(AdminChecklistResultController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('{id}/view', 'view')->name('view');
                    });

            }); // subscription middleware

        }); // admin middleware
    });

/*
| Authenticated Frontend Users
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Frontend User Routes
|--------------------------------------------------------------------------
| URL Prefix: /user
| Route Name Prefix: user.
|--------------------------------------------------------------------------
*/

Route::prefix('user')
    ->name('user.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Guest Routes (Not Logged In)
        |--------------------------------------------------------------------------
        */
        Route::middleware('guest')->group(function () {
            Route::get('/', [AuthController::class, 'login'])->name('login');
            Route::get('/login', [AuthController::class, 'login'])->name('login');
            Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
        });

        /*
        |--------------------------------------------------------------------------
        | Authenticated User Routes
        |--------------------------------------------------------------------------
        */
        Route::middleware('auth')->group(function () {

            Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
            Route::get('change-password', [AuthController::class, 'changePassword'])->name('change.password');
            Route::post('update-password', [AuthController::class, 'updatePassword'])->name('update.password');
            Route::get('profile', [AuthController::class, 'adminProfile'])->name('profile');
            Route::post('profile', [AuthController::class, 'updateAdminProfile'])->name('update.profile');
            Route::get('sop', [WebSopController::class, 'sop'])->name('sop');
            Route::get('/sop/view/{id}', [WebSopController::class, 'view'])->name('sop.view');
            Route::get('/sop/{id}/qa', [WebSopController::class, 'qa'])->name('sop.qa');
            Route::post('/sop/qa', [WebSopController::class, 'qaSubmit'])->name('sop.qa.submit');
            Route::get('checklist', [WebChecklistController::class, 'index'])->name('checklist');
            Route::get('/checklist/{id}/qa', [WebChecklistController::class, 'qa'])->name('checklist.qa');
            Route::post('/checklist/qa', [WebChecklistController::class, 'qaSubmit'])->name('checklist.qa.submit');
            Route::get('/video', [WebVideoController::class, 'video'])->name('video');
            Route::get('/video/{id}/qa', [WebVideoController::class, 'qa'])->name('video.qa');
            Route::post('/video/qa', [WebVideoController::class, 'qaSubmit'])->name('video.qa.submit');
            Route::get('/sop-results', [WebSopResultController::class, 'sopResults'])->name('sop.results');
            Route::get('/sop-results/{id}/view', [WebSopResultController::class, 'view'])->name('sop.result.view');
            Route::get('/video-results', [WebVideoResultController::class, 'videoResults'])->name('video.results');
            Route::get('/video-results/{id}/view', [WebVideoResultController::class, 'view'])->name('video.result.view');
            Route::get('/checklist-results', [WebChecklistResultController::class, 'checklistResults'])->name('checklist.results');
            Route::get('/checklist-results/{id}/view', [WebChecklistResultController::class, 'view'])->name('checklist.result.view');
        });
    });


    Route::prefix('sop-results')->name('sop.result.')->controller(AdminSopResultController::class)->group(function () {
                /* ================= SOP Results ================= */
                Route::get('/','index')->name('index');
                Route::get('/{id}/view','view')->name('view');
            });

            Route::prefix('video-results')->name('video.result.')->controller(AdminVideoResultController::class)->group(function () {
                /* ================= Video Results ================= */
                Route::get('/','index')->name('index');
                Route::get('/{id}/view','view')->name('view');
            });
