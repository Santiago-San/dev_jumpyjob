<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDataController;
use Illuminate\Http\Request;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\JoblistController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Show Register/Create Form
Route::get('/register', [UserController::class, 'create']);
Route::get('/joblist/{catslug?}', [JoblistController::class, 'index']);
Route::get('/category/{slug?}', [JoblistController::class, 'category']);
Route::get('/joblist/detail/{slug?}', [JoblistController::class, 'detail']);

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);



// Update User Profile
Route::post('/user/profile', [UserDataController::class, 'store']);

/*company dashboard */
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/account', [AccountController::class, 'account'])->middleware('auth');
Route::get('/profile', [AccountController::class, 'profile'])->middleware('auth');
Route::post('/profile', [AccountController::class, 'profile'])->middleware('auth');
Route::get('/jobs', [JobsController::class, 'index'])->middleware('auth');
Route::get('/jobs/add/{id?}', [JobsController::class, 'add'])->middleware('auth');
Route::post('/jobs/add/{id?}', [JobsController::class, 'add'])->middleware('auth');
Route::get('/jobs/categories', [JobsController::class, 'categories'])->middleware('auth');
Route::get('/jobs/addcategory/{id?}', [JobsController::class, 'addcategory'])->middleware('auth');
Route::post('/jobs/addcategory/{id?}', [JobsController::class, 'addcategory'])->middleware('auth');
Route::post('/ajax/changeCatSt', [JobsController::class, 'changeCatSt'])->middleware('auth');

Route::post('/ajax/removeJobCat', [JobsController::class, 'removeJobCat'])->middleware('auth');
Route::post('/ajax/removeJobs', [JobsController::class, 'removeJobs'])->middleware('auth');
Route::post('/ajax/getSubCategory', [JobsController::class, 'getSubCategory']);
Route::post('/ajax/changeJobSt', [JobsController::class, 'changeJobSt'])->middleware('auth');
Route::post('/applyjobs', [JoblistController::class, 'applyjobs']);
Route::get('/application', [JobsController::class, 'appliedCandidate'])->middleware('auth');
/*company dashboard */

/*admin */
Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::get('/admin/profile', [AdminController::class, 'profile']);
        Route::post('/admin/profile', [AdminController::class, 'profile']);
        Route::post('/admin/changepassword', [AdminController::class, 'changepassword']);
        Route::get('/admin/changepassword', [AdminController::class, 'changepassword']);
        Route::get('/admin/logout', [AdminController::class, 'logout']);
        Route::get('/admin/jobs', [AdminController::class, 'jobs']);
        Route::get('/admin/addjobs/{id?}', [AdminController::class, 'addJobs']);
        Route::post('/admin/addjobs/{id?}', [AdminController::class, 'addJobs']);
        Route::get('/admin/jobs/category', [AdminController::class, 'jobscategory']);
		Route::post('/ajax/admin/changeCatSt', [JobsController::class, 'changeCatSt']);
		Route::post('/ajax/admin/removeJobCat', [JobsController::class, 'removeJobCat']);
		Route::post('/admin/addjobscategory', [JobsController::class, 'addjobscategory']);
		Route::get('/admin/jobs/addcategory/{id?}', [AdminController::class, 'addjobscategory']);
		Route::post('/admin/jobs/addcategory/{id?}', [AdminController::class, 'addjobscategory']);
		Route::get('/admin/pages', [AdminController::class, 'pages']);
		Route::get('/admin/addpage/{id?}', [AdminController::class, 'addpage']);
		Route::post('/admin/addpage/{id?}', [AdminController::class, 'addpage']);
		Route::post('/ajax/admin/changepagestatus', [AdminController::class, 'changepagestatus']);
		Route::post('/ajax/admin/removePage', [AdminController::class, 'removePage']);
		
		Route::post('/ajax/admin/removeJobs', [JobsController::class, 'removeJobs']);
		Route::post('/ajax/admin/changeJobSt', [JobsController::class, 'changeJobSt']);

		/*faq*/
		Route::get('/admin/jobapplications', [AdminController::class, 'jobapplications']);
		Route::get('/admin/faqs', [AdminController::class, 'faqs']);
		Route::get('/admin/addfaq/{id?}', [AdminController::class, 'addfaq']);
		Route::post('/admin/addfaq/{id?}', [AdminController::class, 'addfaq']);
		Route::post('/ajax/admin/changefaqstatus', [AdminController::class, 'changefaqstatus']);
		Route::post('/ajax/admin/removefaq', [AdminController::class, 'removefaq']);
		Route::get('/admin/employers', [AdminController::class, 'employers']);
		Route::get('/admin/addemployer/{id?}', [AdminController::class, 'addemployer']);
		Route::post('/admin/addemployer/{id?}', [AdminController::class, 'addemployer']);
		Route::post('/ajax/admin/changeemployerstatus', [AdminController::class, 'changeemployerstatus']);
		Route::post('/ajax/admin/removeemployer', [AdminController::class, 'removeemployer']);
		/*faq*/
    });

Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'login']);
/*admin */