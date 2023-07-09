<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
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

  // MultiImage:編集のルート
  Route::get('/edit/multi/image/{id}', 'EditMultiImage')
    ->name('edit.multi.image');

  // MultiImage:更新処理のルート
  Route::post('/update/multi/image', 'UpdateMultiImage')
    ->name('update.multi.image');

  // MultiImage:削除処理のルート
  Route::get('/delete/multi/image/{id}', 'DeleteMultiImage')
    ->name('delete.multi.image');
});

// Porfolio All Route 
Route::controller(PortfolioController::class)->group(function () {
  Route::get('/all/portfolio', 'AllPortfolio')
    ->name('all.portfolio');

  // portfolio:新規作成のルート
  Route::get('/add/portfolio', 'AddPortfolio')
    ->name('add.portfolio');

  // portfolio:保存処理のルート
  Route::post('/store/portfolio', 'StorePortfolio')
    ->name('store.protfolio');

  // portfolio:編集のルート
  Route::get('/edit/portfolio/{id}', 'EditPortfolio')
    ->name('edit.portfolio');

  // portfolio:更新処理のルート
  Route::post('/update/portfolio', 'UpdatePortfolio')
    ->name('update.protfolio');

  // portfolio:削除処理のルート 
  Route::get('/delete/portfolio/{id}', 'DeletePortfolio')
    ->name('delete.portfolio');

  // portfolio:詳細のルート(Frontend疎通)
  Route::get('/portfolio/details/{id}', 'PortfolioDetails')
    ->name('portfolio.details');
});

// Blog Category All Routes 
Route::controller(BlogCategoryController::class)->group(function () {

  // BlogCategory:一覧のルート
  Route::get('/all/blog/category', 'AllBlogCategory')
    ->name('all.blog.category');

  // BlogCategory:新規作成のルート
  Route::get('/add/blog/category', 'AddBlogCategory')
    ->name('add.blog.category');

  // BlogCategory:保存処理のルート 
  Route::post('/store/blog/category', 'StoreBlogCategory')
    ->name('store.blog.category');

  // BlogCategory:編集のルート
  Route::get('/edit/blog/category/{id}', 'EditBlogCategory')
    ->name('edit.blog.category');

  // BlogCategory:更新処理ののルート    
  Route::post('/update/blog/category/{id}', 'UpdateBlogCategory')
    ->name('update.blog.category');

  // BlogCategory:削除処理のルート    
  Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')
    ->name('delete.blog.category');
});

// Blog All Route 
Route::controller(BlogController::class)->group(function () {

  // Blog:一覧のルート
  Route::get('/all/blog', 'AllBlog')
    ->name('all.blog');

  // Blog:新規作成のルート
  Route::get('/add/blog', 'AddBlog')
    ->name('add.blog');

  // Blog:保存処理のルート
  Route::post('/store/blog', 'StoreBlog')
    ->name('store.blog');

  // Blog:編集のルート
  Route::get('/edit/blog/{id}', 'EditBlog')
    ->name('edit.blog');

  // Blog:更新処理のルート    
  Route::post('/update/blog', 'UpdateBlog')
    ->name('update.blog');

  // Blog:削除処理のルート   
  Route::get('/delete/blog/{id}', 'DeleteBlog')
    ->name('delete.blog');

  // Blog:詳細のルート(Frontend) 
  Route::get('/blog/details/{id}', 'BlogDetails')
    ->name('blog.details');

  Route::get('/category/blog/{id}', 'CategoryBlog')
    ->name('category.blog');

  Route::get('/blog', 'HomeBlog')
    ->name('home.blog');

  Route::get('/blog', 'HomeBlog')
    ->name('home.blog');
});

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
