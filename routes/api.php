<?php
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AuthController;
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
//Public route
Route::get('/hospitals', [HospitalController::class, 'index']);
Route::get('/hospitals/{id}', [HospitalController::class, 'show']);
Route::get('/hospitals/search/{name}', [HospitalController::class,'search']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Protected route
Route::group(['middleware' => ['auth:sanctum']],function () {
    Route::post('/hospitals',  [HospitalController::class, 'store']);
    Route::put('/hospitals/{id}',  [HospitalController::class, 'update']);
    Route::delete('/hospitals/{id}',  [HospitalController::class, 'destroy']);
    Route::post('/logout',  [AuthController::class, 'logout']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
