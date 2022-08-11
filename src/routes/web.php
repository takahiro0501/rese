<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\FavoriteShopsController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;


//店舗一覧・店舗詳細ページ
Route::get('/', [ShopsController::class, 'home']);
Route::get('/home', [ShopsController::class, 'index'])->name('home');
Route::get('/home/search', [ShopsController::class, 'search'])->name('home.search');
Route::get('/detail/{shop_id}/{reservation_id?}', [ShopsController::class, 'detail'])->name('detail');
//予約認証ページ
Route::get('/qr/verify/{token}', [MypageController::class, 'qrVerify'])->name('qr.verify');

//メール認証が完了したログインユーザのみ
Route::middleware('auth', 'verified')->group(function () {
  //お気に入り機能
  Route::post('/favorite/store', [FavoriteShopsController::class, 'store'])->name('favorite.store');
  Route::post('/favorite/destory', [FavoriteShopsController::class, 'destory'])->name('favorite.destory');
  //マイページ
  Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
  Route::get('/mypage/destory/{reservation_id}', [MypageController::class, 'destory'])->name('mypage.destory');
  //マイページ:QRコード
  Route::get('/mypage/qr/{reservation_id}', [MypageController::class, 'qr'])->name('mypage.qr');
  //マイページ:決済ページ
  Route::get('/mypage/payment/{reservation_id}', [MypageController::class, 'payment'])->name('mypage.payment');
  Route::post('/mypage/payment', [MypageController::class, 'pay'])->name('mypage.pay');
  //予約機能
  Route::post('/reserve', [ReservationsController::class, 'store'])->name('reserve');
  Route::post('/reserve/re', [ReservationsController::class, 'update'])->name('reserve.re');
  //評価機能
  Route::get('/mypage/rating/{reservation_id}/{shop_name}', [RatingsController::class, 'index'])->name('mypage.rating');
  Route::post('/mypage/rating/store', [RatingsController::class, 'store'])->name('mypage.rating.store');
});

//管理画面ログイン
Route::prefix("/admin")->group(function() {
  //ログイン
  Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
  Route::post('/login', [AdminController::class, 'store'])->name('admin.store');
  //ログアウト
  Route::get('/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');
  //権限別ルート振り分け
  Route::get('/route', [AdminController::class, 'adminRoute'])->name('admin.route');
});

//管理画面:店舗管理者（manager）権限
Route::group(['middleware' => 'permission:manager'], function () {
  Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
  Route::post('/admin/create', [AdminController::class, 'create'])->name('admin.create');
});

//管理画面:店舗代表者（shopManager）権限
Route::group(['middleware' => 'permission:shopManager'], function () {
  Route::get('/manager/home', [ManagerController::class, 'index'])->name('manager.home');
  Route::get('/admin/shop', [ManagerController::class, 'shop'])->name('manager.shop');
  Route::post('/admin/shop/store', [ManagerController::class, 'store'])->name('manager.shop.store');
  Route::get('/admin/shop/update', [ManagerController::class, 'update'])->name('manager.shop.update');
  Route::post('/admin/shop/update', [ManagerController::class, 'updateExec'])->name('manager.shop.update.exec');
  Route::get('/admin/reservation', [ManagerController::class, 'reservation'])->name('manager.reservation');
  Route::get('/admin/search', [ManagerController::class, 'search'])->name('manager.search');
  Route::get('/admin/mail/{user_id}', [ManagerController::class, 'mail'])->name('manager.mail');
  Route::post('/admin/mail/send', [ManagerController::class, 'send'])->name('manager.send');
});

require __DIR__.'/auth.php';
