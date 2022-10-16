<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\GeoLocationController;

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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/usersPagination', [UserController::class, 'index']);
    Route::post('/user/create', [UserController::class, 'store']);
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/delete/user/{id}', [UserController::class, 'destroy']);

    Route::get('/rolesPagination', [RoleController::class, 'index']);
    Route::get('/roles', [RoleController::class, 'getAll']);
    Route::post('/role/create', [RoleController::class, 'store']);
    Route::put('/role/update/{id}', [RoleController::class, 'update']);
    Route::delete('/delete/role/{id}', [RoleController::class, 'destroy']);

    Route::get('/permissions', [PermissionController::class, 'index']);
    Route::post('assign/permission', [PermissionController::class, 'store']);

    Route::get('/menus', [MenuController::class, 'index']);
    Route::post('/menu/create', [MenuController::class, 'store']);
    Route::put('/menu/sorting', [MenuController::class, 'sorting']);
    Route::patch('/menus/{id}', [MenuController::class, 'updateVisibility']);
    Route::put('/menu/update/{id}', [MenuController::class, 'update']);


    //Subscriber 
    Route::get('/subscriber', [SubscriberController::class, 'index']);
    Route::post('/subscriber/create', [SubscriberController::class, 'store']);
    Route::put('/subscriber/update/{id}', [SubscriberController::class, 'update']);
    Route::delete('/delete/subscriber/{id}', [SubscriberController::class, 'destroy']);
    

    //Subscription
    Route::get('/subscription', [SubscriptionController::class, 'index']);
    Route::post('/subscription/create', [SubscriptionController::class, 'store']);
    Route::put('/subscription/update/{id}', [SubscriptionController::class, 'update']);
    Route::delete('/delete/subscription/{id}', [SubscriptionController::class, 'destroy']);

    //Plan']);
    Route::get('/plan', [PlanController::class, 'index']);
    Route::post('/plan/create', [PlanController::class, 'store']);
    Route::put('/plan/update/{id}', [PlanController::class, 'update']);
    Route::delete('/delete/plan/{id}', [PlanController::class, 'destroy']);

    //Geo Loacations
    Route::get('/state-cities', [GeoLocationController::class, 'stateCities']);
    Route::get('/villages', [GeoLocationController::class, 'villagesArea']);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

