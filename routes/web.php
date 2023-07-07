<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
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
  Route::get('/home/slide', 'HomeSlider')
    ->name('home.slide');

  // Home Slide:更新処理のルート
  Route::post('/update/slider', 'UpdateSlider')
    ->name('update.slider');
});

// About Page All Route 
Route::controller(AboutController::class)->group(function () {

  // About Page:詳細のルート
  Route::get('/about/page', 'AboutPage')
    ->name('about.page');

  // About Page:詳細のルート
  Route::post('/update/about', 'UpdateAbout')
    ->name('update.about');

  // About Page:aboutページ疎通のルート
  Route::get('/about', 'HomeAbout')
    ->name('home.about');

  Route::get('/about/multi/image', 'AboutMultiImage')
    ->name('about.multi.image');

  Route::post('/store/multi/image', 'StoreMultiImage')
    ->name('store.multi.image');

  // MultiImage:一覧表示のルート
  Route::get('/all/multi/image', 'AllMultiImage')
    ->name('all.multi.image');
});


Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
