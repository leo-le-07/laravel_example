<?php
use App\Modules\User\Controllers\HospitalController;
use App\Modules\User\Controllers\AuthController;
use App\Modules\User\Controllers\SpecialtyController;
use App\Modules\User\Controllers\DoctorController;
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

Route::get('/specialties',  [SpecialtyController::class, 'index']);
Route::get('/specialties/{id}',  [SpecialtyController::class, 'show']);

Route::get('/doctors',  [DoctorController::class, 'index']);
Route::get('/doctors/{id}',  [DoctorController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Protected route
Route::group(['middleware' => ['auth:sanctum']],function () {
    Route::post('/hospitals',  [HospitalController::class, 'store']);
    Route::put('/hospitals/{id}',  [HospitalController::class, 'update']);
    Route::delete('/hospitals/{id}',  [HospitalController::class, 'destroy']);

    Route::post('/specialties',  [SpecialtyController::class, 'store']);
    Route::put('/specialties/{id}',  [SpecialtyController::class, 'update']);
    Route::delete('/specialties/{id}',  [SpecialtyController::class, 'destroy']);

    Route::post('/doctors',  [DoctorController::class, 'store']);
    Route::put('/doctors/{id}',  [DoctorController::class, 'update']);
    Route::delete('/doctors/{id}',  [DoctorController::class, 'destroy']);

    Route::post('/logout',  [AuthController::class, 'logout']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
