<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

//user route

Route::get('/', 'Frontend\HomeController@index');
Route::get('resume', 'Frontend\ResumeController@index');
Route::get('portfolio', 'Frontend\PortfolioController@index');
Route::get('workdetails', 'Frontend\PortfolioController@portfolioindex');
Route::get('blog', 'Frontend\BlogController@index');
Route::get('contact', 'Frontend\ContactController@index');
    // Route::get('/blogdestails', 'Frontend\HomeController@index');

// Route::get('/', function () {
//     return view('frontend/page/home');
// });

Auth::routes();
Route::group(['prefix' => 'admin'],function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
    Route::resource('work','Backend\WorkController',['names' => 'admin.work'])->middleware('auth');
    Route::resource('category','Backend\CategoryController',['names' => 'admin.category'])->middleware('auth');
    Route::post('category/update', 'Backend\CategoryController@categoryupdate')->name('admin.category.data.update')->middleware('auth');
    Route::get('category/delete/data/{cat_id}', 'Backend\CategoryController@categorydelete')->middleware('auth');
    Route::get('category/status/{cat_id}', 'Backend\CategoryController@changestatus')->middleware('auth');
    Route::resource('workskill', 'Backend\WorkskillController',['names' => 'admin.work.skill'])->middleware('auth');
    Route::post('work/skill/update', 'Backend\WorkskillController@skillupdate')->name('admin.work.skill.data.update')->middleware('auth');
    Route::get('work/skill/data/{s_id}', 'Backend\WorkskillController@skilldelete')->middleware('auth');
    Route::get('workskill/status/{s_id}', 'Backend\WorkskillController@skillstatus')->middleware('auth');


});

