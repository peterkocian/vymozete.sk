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

/* Auth routes generated by Laravel */
Auth::routes();

/* Admin routes */
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth')->group(function() {

});


/* Front routes */
Route::namespace('Front')->name('front.')->group(function() {
    Route::get('/', 'PublicController@index');
    Route::get('/vop', 'PublicController@vop');
    Route::get('/home', 'PublicController@home');
    Route::get('/admin', 'HomeController@index')->name('admin');
});
