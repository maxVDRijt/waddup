<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

//Route::get('/', function () {
//    return view('home');
//});

//  Auth related pages
Route::get('/account', [AuthController::class,'account'])->name('auth.login');
Route::post('/login', [AuthController::class,'login'])->name('auth.check');
Route::post('/register', [AuthController::class,'store'])->name('auth.store');
Route::get('/logout', [AuthController::class,'logout'])->name('auth.logout');

//  Check user is logged in
Route::middleware(['CheckAuth'])->group(function () {
//    User related pages
    Route::get('/', 'UserController@dashboard')->name('user.dashboard');

//    Friend related pages
//    Route::post('/friend/add', 'FriendController@store')->name('friend.add');
//    Route::post('/friend/accept/{id}', 'FriendController@accept')->name('friend.accept');
//    Route::post('/friend/decline/{id}', 'FriendController@decline')->name('friend.decline');

//    Message related pages
//    Route::post('/message/send/{id}', 'MessageController@store')->name('message.send');

});
