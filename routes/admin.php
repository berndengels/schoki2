<?php

use Illuminate\Support\Facades\Auth;

Auth::routes();
Auth::routes(['register' => false]);

Route::prefix('admin')->group(function () {
/*
	Route::get('/cache/flush', 'Admin\CacheController@flush')->name('admin.service.cacheFlush');
	Route::get('/cache/clear', 'Admin\CacheController@clear')->name('admin.service.cacheClear');
    Route::get('/cache/forget/{key}', 'Admin\CacheController@forget')->name('admin.service.cacheForget');
*/
	Route::group([
		'prefix' => 'menus',
	], function () {
		Route::get('show', 'Admin\MenuController@show')->name('admin.menuShow');
		Route::get('edit', 'Admin\MenuController@edit')->name('admin.menuNew');
		Route::post('operation/{operation}', 'Admin\MenuController@operation')->name('admin.menuOperation');
		Route::post('store', 'Admin\MenuController@store')->name('admin.menuStore');
		Route::get('icons', 'Admin\MenuController@icons')->name('admin.menuIcons');
	});
});
