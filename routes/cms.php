<?php
/**
 * Created by PhpStorm.
 * User: Rabee
 * Date: 22/07/2019
 * Time: 01:28
 */


use Illuminate\Support\Facades\Route;


Route::prefix('cms')->group(function () {



    Route::get('/', 'CmsController@index')->name('dashboard');
    Route::get('static/{terms}', 'CmsController@getStatic')->name('getStatic');
    Route::put('static/{terms}', 'CmsController@putStatic')->name('putStatic');

    Route::resource('status', 'StatusController');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('realestate', 'RealestateController');
    Route::resource('building', 'BuildingController');
    Route::resource('villa', 'VillaController');
    Route::resource('floor', 'FloorController');
    Route::resource('project-feature', 'ProjectFeatureController');
    Route::resource('project-service', 'ProjectServiceController');
    Route::resource('project-guarantee', 'ProjectGuaranteeController');
    Route::resource('project-category', 'ProjectCategoryController');
    Route::resource('blog', 'BlogController');
    Route::resource('business-category', 'BusinessCategoryController');
    Route::resource('business-project', 'BusinessProjectController');
    Route::resource('sales-status', 'SalesStatusController');
    Route::resource('apartment-status', 'ApartmentStatusController');
    Route::resource('apartment', 'ApartmentController');
    Route::resource('apartment-request', 'ApartmentRequestController');
    Route::resource('villa-request', 'VillaRequestController');
    Route::resource('plot-request', 'PlotRequestController');
    Route::resource('office-request', 'OfficeRequestController');
    Route::resource('contact-request', 'ContactRequestController');
    Route::resource('maintenance-request', 'MaintenanceRequestController');
    Route::resource('service-category', 'ServiceCategoryController');
    Route::resource('service', 'ServiceController');
    Route::resource('location', 'LocationController');
    Route::resource('about', 'AboutController');
    Route::resource('setting', 'SettingController');
    Route::resource('about-info', 'AboutInfoController');
    Route::resource('our-value', 'OurValueController');
    Route::resource('our-goal', 'OurGoalController');
    Route::resource('banner', 'BannerController');
    Route::resource('team', 'TeamController');
    Route::resource('manager', 'ManagerController');
    Route::resource('land', 'LandController');
    Route::resource('plot', 'PlotController');
    Route::resource('office', 'OfficeController');
    Route::resource('showroom', 'ShowroomController');
    Route::resource('social-service', 'SocialServiceController');
    Route::resource('award', 'AwardController');
    Route::resource('appearance-module', 'AppearanceModuleController');
   
    Route::get('building/{id}/edit/ajax','BuildingController@editAjax')->name('building.edit.ajax');


    Route::post('realestate/{id}/image-upload', 'RealestateController@uploadImage')->name('realestate.image-upload');
    Route::post('realestate/{id}/image-remove', 'RealestateController@removeImage')->name('realestate.image-remove');
    Route::get('realestate/{id}/images', 'RealestateController@getGallery')->name('realestate.images');


    Route::post('business-project/{id}/image-upload', 'BusinessProjectController@uploadImage')->name('business-project.image-upload');
    Route::post('business-project/{id}/image-remove', 'BusinessProjectController@removeImage')->name('business-project.image-remove');
    Route::get('business-project/{id}/images', 'BusinessProjectController@getGallery')->name('business-project.images');





    Route::namespace('Front')->group(function () {
        Route::resource('home', 'HomeController');
    });



    Route::post('uploader/media', 'CmsController@storeMedia')
        ->name('cms.storeMedia');

});
