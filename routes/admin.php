<?php

use App\Http\Controllers\Admin\{AuthController,
    HomeController,

};
use Illuminate\Support\Facades\Route;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/admin',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {


    Route::get('login', [AuthController::class, 'loginView'])->name('admin.login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('admin.postLogin');

});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/admin',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'admin']
    ], function() {


    Route::group([ 'middleware' => 'admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('admin.index');
        Route::get('calender', [HomeController::class, 'calender'])->name('admin.calender');

        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

        ### admins

        Route::resource('admins', \App\Http\Controllers\Admin\AdminController::class);
        Route::get('activateAdmin', [App\Http\Controllers\Admin\AdminController::class, 'activate'])->name('admin.active.admin');


        ### roles
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);//setting


        ### orders
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);//setting
        Route::get('makeRowDetailsForOrder', [\App\Http\Controllers\Admin\OrderController::class,'makeRowDetailsForOrder'])->name('admin.makeRowDetailsForOrder');//setting

        ### orderDetails
        Route::resource('ordersDetails', \App\Http\Controllers\Admin\OrderDetailsController::class);//setting
        Route::get('orderDetails/{id}', [\App\Http\Controllers\Admin\OrderDetailsController::class,'index'])->name('order.orderDetails');//setting



        ### setting
        Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);



        ### clients
        Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class);//setting
        Route::get('getCitiesForGovernorate/{id}', [\App\Http\Controllers\Admin\ClientController::class,'getCitiesForGovernorate'])->name('admin.getCitiesForGovernorate');//setting


        ### countries
        Route::resource('countries', \App\Http\Controllers\Admin\Area\CountryController::class);//setting


        ### provinces
        Route::resource('provinces', \App\Http\Controllers\Admin\Area\ProvinceController::class);//setting


        ### types
        Route::resource('types', \App\Http\Controllers\Admin\TypeController::class);//setting

        ### STAGES
        Route::resource('stages', \App\Http\Controllers\Admin\StageController::class);//setting

        ### Categories
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);//setting


        ### items
        Route::resource('items', \App\Http\Controllers\Admin\ItemController::class);//setting


    });

});
