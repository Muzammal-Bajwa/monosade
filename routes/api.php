<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apicontroller;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//Route::get('login', [LoginController::class, 'login']);

Route::get('login', 'apicontroller@login');

Route::post('login', [apicontroller::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [apicontroller::class, 'logout']);
    Route::get('/get-projects', [apicontroller::class, 'getProjects']);
    Route::get('/get-workspace', [apicontroller::class, 'getworkspace']);
    Route::post('add-tracker', [apicontroller::class, 'addTracker']);
    Route::post('stop-tracker', [apicontroller::class, 'stopTracker']);
    Route::post('upload-photos', [apicontroller::class, 'uploadImage']);




    // Route::post('logout', 'apicontroller@logout');
    // Route::get('/get-projects', 'apicontroller@getProjects');
    //  Route::get('/get-workspace', 'apicontroller@getworkspace');
    // Route::post('add-tracker', 'apicontroller@addTracker');
    // Route::post('stop-tracker', 'apicontroller@stopTracker');
    // Route::post('upload-photos', 'apicontroller@uploadImage')
});
