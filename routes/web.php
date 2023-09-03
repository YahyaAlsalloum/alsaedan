<?php

use Illuminate\Support\Facades\Route;
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
// Route::group(['prefix' => '{locale}'], function ($locale) {
    
   
   // die("request()->route('locale')");
        // Or, alternatively, use the request() helper to get the 'locale' parameter
        // $localeValue = request()->route('locale');
    
   

// 	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
// 	Route::get('/', function()
// 	{
// 		return View::make('hello');
// 	});

// 	Route::get('test',function(){
// 		return View::make('test');
// 	});


Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [  ]], function()
{
        
        Route::get('home/{local}', 'Front\HomeController@index')->name('home');
        Route::get('/about-us/{local}', 'Front\HomeController@about')->name('about-us');
        Route::get('/social-services/{local}', 'Front\HomeController@awards')->name('social-services');
        Route::get('/blog-details/{slug}/{local}', 'Front\HomeController@blogDetails')->name('blog.details');
        Route::get('/blog/{local}', 'Front\HomeController@blog')->name('blog');
        Route::get('/contact-us/{local}', 'Front\HomeController@contactUs')->name('contact-us');
        Route::get('/deem/{local}', 'Front\HomeController@deem')->name('deem');
        Route::get('/maintenance/{local}', 'Front\HomeController@maintenance')->name('maintenance');
        Route::get('/projects-details/{local}/{slug}','Front\HomeController@projectsDetails')->name('project.details');
        Route::get('/projects/{local}/{slug}', 'Front\HomeController@projects')->name('projects');
        Route::get('/realestate/{local}', 'Front\HomeController@realestate')->name('realestate');
        Route::get('/realestate-details/{local}/{slug}', 'Front\HomeController@realestateDetails')->name('realestate-details');
        Route::get('/services/{local}/{slug}/{activeService?}', 'Front\HomeController@services')->name('services');
        Route::get('/business/{local}', 'Front\HomeController@business')->name('business');
});
Route::prefix('admin')->group(function(){});
Route::get('/verify/{token}', 'Front\Auth\AuthController@verify')->name('verify');

Route::post('password/email', 'Front\Auth\AuthController@sendResetEmail');

Route::post('reset-password', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password-reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.new.request');

Route::post('password/email', 'Front\HomeController@sendResetEmail');

Route::post('ajax-search', 'Front\HomeController@ajaxSearch')->name('ajax.search');
Route::post('ajax-hide', 'Front\HomeController@hideAjax')->name('hide.ajax');
Route::post('project-search', 'Front\HomeController@projectSearch')->name('project.search');
Route::post('request-apartment', 'Front\HomeController@requestApartment')->name('request.apartment');
Route::post('request-plot', 'Front\HomeController@requestPlot')->name('request.plot');
Route::post('request-office', 'Front\HomeController@requestOffice')->name('request.office');
Route::post('request-villa', 'Front\HomeController@requestVilla')->name('request.villa');
Route::post('submit-contact', 'Front\HomeController@submitContact')->name('submit.contact');
Route::post('submit-maintenance', 'Front\HomeController@submitMaintenance')->name('submit.maintenance');
Route::get('/select-ajax/{model?}', 'CMS\CmsController@ajaxSelectByModel')->name('select.ajax');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
});
Route::get('/', 'Front\HomeController@indexPge')->name('indexPage');


