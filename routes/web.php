<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('frontend.index');
});

Route::get('/dashboard', function () {
  return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(AdminController::class)->group(function () {
  Route::get('/admin/logout', 'AdminLogout')
    ->name('admin.logout');

  // プロフィール:詳細のルート
  Route::get('/admin/profile', 'Profile')
    ->name('admin.profile');

  // プロフィール:編集のルート
  Route::get('/edit/profile', 'EditProfile')
    ->name('edit.profile');

  // プロフィール:保存のルート
  Route::post('/store/profile', 'StoreProfile')
    ->name('store.profile');

  // パスワード変更処理のルート
  Route::get('/change/password', 'ChangePassword')
    ->name('change.password');

  // パスワード更新のルート
  Route::post('/update/password', 'UpdatePassword')
    ->name('update.password');
});

// Home Slide All Route 
Route::controller(HomeSliderController::class)->group(function () {
  Route::get('/home/slide', 'HomeSlider')->name('home.slide');
});


Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
