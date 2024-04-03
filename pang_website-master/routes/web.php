<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use user\JobListController;
use user\JobDetailController;
use user\Family_OriginController;

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



// Route::get('search', function () {
//     return view('search');
// })->name('site.search');

// testing purpose
Route::get('test', function () {
    return view('test');
})->name('site.test');

// user route
Route::group(['namespace' => 'user'], function () {
    Route::get('summernote', function () {
        return view('user.summernote');
    });
    Route::get('chart', function () {
        return view('user.chart');
    })->name('user.chart');
    // Route::get('background', function () {
    //     return view('user.background');
    // })->name('user.background');
    Route::get('rules', function () {
        return view('user.rules');
    })->name('user.rules');
    Route::get('/', function () {
        return view('user.home');
    })->name('user.home');
    Route::resource('search', 'SearchController');

    Route::get('fetch-family-list/{id}', 'ChartController@fetchfamilylist');
    Route::get('getList/{year}', 'Family_OriginController@getList');
    Route::POST('downloadPDF', 'ChartController@downloadPDF');
    Route::get('history/{id}', 'PeopleHistoryController@getPeople')->name('user.history');
    Route::get('chart/{id}', function () {
        return view('user.chart');
    });
    Route::POST('deleteImageFile', '\App\Services\ImageManager@deleteImageFile');
    Route::POST('deleteVideoFile', '\App\Services\MediaManager@deleteVideoFile');
});

// Auth::routes();
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect('/admin/login');
    });

    Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]);

    Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::resource('relationship', 'PersonController');
        Route::resource('user', 'AdminController');
        Route::resource('theme', 'ThemeController');
        Route::resource('page', 'PageController');
        Route::resource('blog', 'BlogController');
        Route::resource('job', 'JobController');
        Route::resource('business', 'BusinessController');
        Route::resource('people_history', 'PeopleHistoryController');
        Route::resource('event', 'EventController');
        Route::resource('notice', 'NoticeController');
        Route::resource('family_origin', 'Family_OriginController');
    });
}); 
// Route::group(['prefix' => 'admin'], function () {
//     Auth::routes();
// });
Route::get('/logout', 'Auth\LoginController@logout');

Route::resource('search', 'User\SearchController');
Route::resource('event', 'User\EventController');
Route::resource('notice', 'User\NoticeController');
Route::resource('job', JobListController::class);
Route::resource('jobDetail', JobDetailController::class);
Route::resource('businessList', 'User\BusinessListController');
Route::resource('family_origin', Family_OriginController::class);

Route::get('businessDetail/{id}', 'User\BusinessDetailController@getBusinessDetail')->name('user.businessDetail');
Route::get('jobDetail/{id}', 'User\JobDetailController@getJobDetail')->name('user.jobDetail');


// Route::get('/chart', [App\Http\Controllers\HomeController::class, 'index'])->name('chart');