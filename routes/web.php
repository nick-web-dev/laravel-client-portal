<?php

use Illuminate\Support\Facades\Route;

Route::view('/pages/template', 'pages.template');
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');
Route::view('/pages/test', 'pages.test-bed');

Route::get('/', 'HomeController@dashboard')->name('dashboard');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::post('/update-user', [App\Services\Rushmore::class, 'updateUser'])->name('update-user');

Route::group(['prefix' => 'announcements'], function(){
    Route::get ('/',                'AnnouncementsController@index')    ->name('announcements-list');
    Route::get('/create',           'AnnouncementsController@create')   ->name('announcement-create');
    Route::post('/create',          'AnnouncementsController@store')    ->name('announcement-store');
    Route::get ('/{announcement}',  'AnnouncementsController@show')     ->name('announcement-view');
    Route::post('/{announcement}',  'AnnouncementsController@update')   ->name('announcement-update');
    Route::post('/status/{id}',  'AnnouncementsController@update_status');
    Route::delete('/{announcement}/delete', 'AnnouncementsController@destroy')->name('announcement-delete');

});

Route::get('/profile', 'ProfileController@index')->name('profile');

Route::group(['prefix' => 'orders'], function() {
	Route::get('/', 'OrdersController@index')->name('orders');
});

Route::group(['prefix' => 'returns'], function() {
	Route::get('/', 'ReturnsController@index')->name('returns');
});

Route::group(['prefix' => 'asn-inventory'], function() {
	Route::get('/', 'ASNInventoryController@index')->name('asn-inventory');
});

Route::group(['prefix' => 'reports'], function() {
    Route::get('/', 'ReportsController@index')->name('reports');
});

Route::view('/components/list', 'pages.list-component');
Route::view('color-test', 'color-test');