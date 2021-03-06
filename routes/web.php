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
    ->group(function() {
        Route::get('/', 'HomeController@index')->name('home')->middleware(['auth','role:super-admin']);
        Route::get('/login', 'LoginController@showLoginForm')->name('loginForm')->middleware('guest');
        Route::post('/login', 'LoginController@login')->name('login')->middleware('guest');
        Route::get('/logout', 'LoginController@logout')->name('logout');
        Route::get('/password/reset', 'LoginController@passwordReset')->name('password.reset');

        Route::middleware(['auth','role:super-admin'])->group(function() {
            Route::resources([
                'users'         => 'UserController',
                'roles'         => 'RoleController',
                'permissions'   => 'PermissionController'
            ]);
            Route::get('/users/{user}/editProfile', 'UserController@editProfile')->name('users.editProfile');
            Route::put('/users/{user}/updateProfile', 'UserController@updateProfile')->name('users.updateProfile');
            Route::post('/users/{user}/ban', 'UserController@ban')->name('users.ban');
            Route::post('/users/{user}/unban', 'UserController@unban')->name('users.unban');

            Route::get('/claims/', 'ClaimController@index')->name('claims.index');
            Route::get('/claims/{claim}/overview', 'ClaimController@overview')->name('claims.overview');
            Route::get('/claims/{claim}/export', 'ClaimController@export')->name('claims.export');
            Route::get('/claims/{claim}/creditor', 'ClaimController@creditor')->name('claims.creditor');
            Route::get('/claims/{claim}/debtor', 'ClaimController@debtor')->name('claims.debtor');
            Route::get('/claims/{claim}/documents', 'FileController@getAllByClaimId')->name('claims.documents.allByClaimId');
            Route::post('/claims/{claim}/documents/upload-files', 'FileController@storeDocument')->name('claims.uploadFiles');

            Route::get('/file/{id}/download', 'FileController@download')->name('file.download');
            Route::delete('/file/{id}/delete', 'FileController@destroy')->name('file.delete');

            Route::get('/claims/{claim}/properties', 'PropertyController@getAllByClaimId')->name('claims.properties.allByClaimId');
            Route::post('/claims/{claim}/properties', 'PropertyController@store')->name('claims.properties.store');
            Route::resource('/claims/{claim}/properties', 'PropertyController')->only(['destroy'])->names([
                'destroy' => 'claims.properties.destroy'
            ]);

            Route::get('/claims/{claim}/calculations', 'CalculationController@getAllByClaimId')->name('claims.calculations.allByClaimId');
            Route::post('/claims/{claim}/calculations/{calculation}/togglePayed', 'CalculationController@togglePayed')->name('claims.calculations.togglePayed');
            Route::resource('/claims/{claim}/calculations', 'CalculationController')->only(['store', 'update', 'destroy', 'edit'])->names([
                'store' => 'claims.calculations.store',
                'update' => 'claims.calculations.update',
                'destroy' => 'claims.calculations.destroy',
                'edit' => 'claims.calculations.edit'
            ]);

            Route::get('/claims/{claim}/notes', 'NoteController@getAllByClaimId')->name('claims.notes.allByClaimId');
            Route::resource('/claims/{claim}/notes', 'NoteController')->only(['store', 'update', 'destroy', 'edit'])->names([
                'store' => 'claims.notes.store',
                'update' => 'claims.notes.update',
                'destroy' => 'claims.notes.destroy',
                'edit' => 'claims.notes.edit'
            ]);

            Route::get('/claims/{claim}/calendar', 'CalendarController@getAllByClaimId')->name('claims.calendar.allByClaimId');
            Route::post('/claims/{claim}/calendar', 'CalendarController@store')->name('claims.calendar.store');
        });
});

/* Front routes */
Route::namespace('Front')->name('front.')->middleware('auth')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/claims/{claim}/overview', 'ClaimController@overview')->name('claims.overview');
    Route::put('/claims/{claim}/overview', 'ClaimController@updateBaseData')->name('claims.updateBaseData');
    Route::get('/claims/{claim}/creditor', 'ClaimController@creditor')->name('claims.creditor');
    Route::put('/claims/{claim}/creditor', 'ClaimController@updateCreditor')->name('claims.updateCreditor');
    Route::get('/claims/{claim}/debtor', 'ClaimController@debtor')->name('claims.debtor');
    Route::put('/claims/{claim}/debtor', 'ClaimController@updateDebtor')->name('claims.updateDebtor');
    Route::get('/claims/{claim}/documents', 'ClaimController@documents')->name('claims.documents.allByClaimId');
    Route::put('/claims/{claim}/documents', 'ClaimController@uploadDocuments')->name('claims.uploadDocuments');
    Route::delete('/file/{id}/delete', 'ClaimController@destroyFile')->name('file.delete');
    Route::get('/users/{user}/editProfile', 'HomeController@editProfile')->name('users.editProfile');
    Route::put('/users/{user}/updateProfile', 'HomeController@updateProfile')->name('users.updateProfile');
    Wizard::routes('/claim', 'ClaimWizardController', 'claim');
});

Route::middleware('auth')->group(function() {
    Route::get('/api/company-data', 'ApiController@getCompanyData');
    Route::get('/file/{id}/download', 'Admin\FileController@download')->name('file.download');//todo zjednotit download link
});

//instead of this
//Route::get('/', 'PublicController@index');
//Route::get('/vop', 'PublicController@vop');
//do this
Route::view('/', 'front.main');
Route::view('/vop', 'front.vop');

/* Auth routes generated by Laravel */
Auth::routes();
//hack to allow GET method for Laravel logout route
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::fallback(function () {
    abort(404);
});
