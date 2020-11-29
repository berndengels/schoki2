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

Route::get('/', function () {
    return view('welcome');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('categories')->name('categories/')->group(static function() {
            Route::get('/',                                             'CategoryController@index')->name('index');
            Route::get('/create',                                       'CategoryController@create')->name('create');
            Route::post('/',                                            'CategoryController@store')->name('store');
            Route::get('/{category}/edit',                              'CategoryController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CategoryController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{category}',                                  'CategoryController@update')->name('update');
            Route::delete('/{category}',                                'CategoryController@destroy')->name('destroy');
            Route::get('/export',                                       'CategoryController@export')->name('export');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('themes')->name('themes/')->group(static function() {
            Route::get('/',                                             'ThemeController@index')->name('index');
            Route::get('/create',                                       'ThemeController@create')->name('create');
            Route::post('/',                                            'ThemeController@store')->name('store');
            Route::get('/{theme}/edit',                                 'ThemeController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ThemeController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{theme}',                                     'ThemeController@update')->name('update');
            Route::delete('/{theme}',                                   'ThemeController@destroy')->name('destroy');
            Route::get('/export',                                       'ThemeController@export')->name('export');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('event-templates')->name('event-templates/')->group(static function() {
            Route::get('/',                                             'EventTemplateController@index')->name('index');
            Route::get('/create',                                       'EventTemplateController@create')->name('create');
            Route::post('/',                                            'EventTemplateController@store')->name('store');
            Route::get('/{eventTemplate}/edit',                         'EventTemplateController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'EventTemplateController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{eventTemplate}',                             'EventTemplateController@update')->name('update');
            Route::delete('/{eventTemplate}',                           'EventTemplateController@destroy')->name('destroy');
            Route::get('/export',                                       'EventTemplateController@export')->name('export');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('event-periodics')->name('event-periodics/')->group(static function() {
            Route::get('/',                                             'EventPeriodicController@index')->name('index');
            Route::get('/create',                                       'EventPeriodicController@create')->name('create');
            Route::post('/',                                            'EventPeriodicController@store')->name('store');
            Route::get('/{eventPeriodic}/edit',                         'EventPeriodicController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'EventPeriodicController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{eventPeriodic}',                             'EventPeriodicController@update')->name('update');
            Route::delete('/{eventPeriodic}',                           'EventPeriodicController@destroy')->name('destroy');
            Route::get('/export',                                       'EventPeriodicController@export')->name('export');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('pages')->name('pages/')->group(static function() {
            Route::get('/',                                             'PageController@index')->name('index');
            Route::get('/create',                                       'PageController@create')->name('create');
            Route::post('/',                                            'PageController@store')->name('store');
            Route::get('/{page}/edit',                                  'PageController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PageController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{page}',                                      'PageController@update')->name('update');
            Route::delete('/{page}',                                    'PageController@destroy')->name('destroy');
            Route::get('/export',                                       'PageController@export')->name('export');
        });
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('events')->name('events/')->group(static function() {
            Route::get('/',                                             'EventController@index')->name('index');
            Route::get('/create',                                       'EventController@create')->name('create');
            Route::post('/',                                            'EventController@store')->name('store');
            Route::get('/{event}/edit',                                 'EventController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'EventController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{event}',                                     'EventController@update')->name('update');
            Route::delete('/{event}',                                   'EventController@destroy')->name('destroy');
            Route::get('/export',                                       'EventController@export')->name('export');
        });
    });
});