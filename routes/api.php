<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookReservationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberReservationController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('books',BookController::class)->only(['index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::resource('books',BookController::class);
    Route::resource('members', MemberController::class);
    Route::resource('reservations',ReservationController::class);
    Route::get('/book/{id}/reservation',[BookReservationController::class,'show']);
    Route::get('/member/{id}/reservation',[MemberReservationController::class,'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
