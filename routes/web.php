<?php

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\ASNInventoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReturnsController;
use Illuminate\Support\Facades\Route;

Route::view('/pages/template', 'pages.template');
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');
Route::view('/pages/test', 'pages.test-bed');
Route::view('/components/list', 'pages.list-component');
Route::view('color-test', 'color-test');

Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/update-user', [App\Services\Rushmore::class, 'updateUser'])->name('update-user');

Route::group(['prefix' => 'announcements'], function () {
    Route::get('/', [AnnouncementsController::class, 'index'])->name('announcements-list');
    Route::get('/create', [AnnouncementsController::class, 'create'])->name('announcement-create');
    Route::post('/create', [AnnouncementsController::class, 'store'])->name('announcement-store');
    Route::get('/{announcement}', [AnnouncementsController::class, 'show'])->name('announcement-view');
    Route::post('/{announcement}', [AnnouncementsController::class, 'update'])->name('announcement-update');
    Route::post('/status/{id}', [AnnouncementsController::class, 'update_status']);
    Route::delete('/{announcement}/delete', [AnnouncementsController::class, 'destroy'])->name('announcement-delete');

});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [OrdersController::class, 'index'])->name('orders');
});

Route::group(['prefix' => 'returns'], function () {
    Route::get('/', [ReturnsController::class, 'index'])->name('returns');
});

Route::group(['prefix' => 'asn-inventory'], function () {
    Route::get('/', [ASNInventoryController::class, 'index'])->name('asn-inventory');
});

Route::group(['prefix' => 'reports'], function () {
    Route::get('/', [ReportsController::class, 'index'])->name('reports');
});

