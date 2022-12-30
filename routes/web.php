<?php

use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/index', function(){
//     $name='Anik Das';
//     $students=['ajad','nilou','hasim','airer'];
//     return view('index' ,compact('name','students'));
// });

//Frontend Route

// Route::get('/',[FrontendController::class,'index'])->name('anik');
Route::get('/',[FrontendController::class,'index']);
Route::get('product/details/{product_id}',[FrontendController::class,'productdetails']);
Route::get('category/wise/product/{category_id}',[FrontendController::class,'categorywiseproduct']);
Route::get('about',[FrontendController::class,'about']);

Route::get('history',[FrontendController::class,'history']);
Route::get('contact',[FrontendController::class,'contact']);
Route::post('contact/post',[FrontendController::class,'contactpost']);


Auth::routes();

//Dashboard Route

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile']);
Route::post('/change/name', [HomeController::class, 'changename']);
Route::post('/change/password', [HomeController::class, 'changepassword']);
Route::post('/change/profile/photo', [HomeController::class, 'change_profilephoto']);
Route::post('/change/cover/photo', [HomeController::class, 'change_coverphoto']);
Route::get('/messages', [HomeController::class, 'messages']);
Route::get('/delete/message/{id}', [HomeController::class, 'deletemessage']);
Route::get('/read/message/{id}', [HomeController::class, 'readmessage']);



Route::get('/category/index',[CategoryController::class,'index']);
Route::post('/category/index/insert',[CategoryController::class,'indexinsert']);
Route::get('/category/edit/{id}',[CategoryController::class,'categoryedit']);
Route::post('/category/update/{id}',[CategoryController::class,'categoryupdate']);
Route::get('/category/delete/{id}',[CategoryController::class,'categorydelete']);



Route::get('/product/brand', [ProductBrandController::class, 'productbrand']);
Route::post('/product/brand/insert', [ProductBrandController::class, 'productbrand_insert']);
Route::get('/product/brand/delete', [ProductBrandController::class, 'productbrand_delet']);

Route::get('/product/index', [ProductController::class, 'index']);
Route::post('/product/index/insert', [ProductController::class, 'productinsert']);


Route::get('banner/index',[BannerController::class, 'banner']);
Route::post('banner/insert',[BannerController::class, 'insert']);
