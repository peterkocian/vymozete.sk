<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Ycs77\LaravelWizard\Facades\Wizard;

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

/* Admin routes */
Route::namespace('Admin')->prefix('admin')->name('admin.')
//    ->middleware('authAdmin')
    ->group(function() {
        Route::get('/', 'HomeController@index')->name('home')->middleware('auth','role:super-admin');
        Route::get('/login', 'LoginController@showLoginForm')->name('loginForm')->middleware('guest');
        Route::post('/login', 'LoginController@login')->name('login')->middleware('guest');
        Route::get('/logout', 'LoginController@logout')->name('logout');
        Route::get('/password/reset', 'LoginController@passwordReset')->name('password.reset');

        Route::middleware('auth')->group(function() {
            Route::resources([
                'users'         => 'UserController',
                'roles'         => 'RoleController',
                'permissions'   => 'PermissionController'
            ]);
            Route::get('/users/{user}/editProfile', 'UserController@editProfile')->name('users.editProfile');
            Route::put('/users/{user}/updateProfile', 'UserController@updateProfile')->name('users.updateProfile');

            Route::get('/claims/', 'ClaimController@index')->name('claims.index');
            Route::get('/claims/{claim}/overview', 'ClaimController@overview')->name('claims.overview');
            Route::get('/claims/{claim}/creditor', 'ClaimController@creditor')->name('claims.creditor');
            Route::get('/claims/{claim}/debtor', 'ClaimController@debtor')->name('claims.debtor');
            Route::get('/claims/{claim}/documents', 'ClaimController@documents')->name('claims.documents');
        });
});

/* Front routes */
Route::namespace('Front')->name('front.')->middleware('auth')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users/{user}/editProfile', 'HomeController@editProfile')->name('users.editProfile');
    Route::put('/users/{user}/updateProfile', 'HomeController@updateProfile')->name('users.updateProfile');
    Wizard::routes('/claim', 'ClaimWizardController', 'claim');
});

Route::middleware('auth')->group(function() {
    Route::get('/api/company-data', 'ApiController@getCompanyData');
});

Route::get('/', 'PublicController@index');
Route::get('/vop', 'PublicController@vop');

/* Auth routes generated by Laravel */
Auth::routes();
//hack to allow GET method for Laravel logout route
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::fallback(function () {
    abort(404);
});
