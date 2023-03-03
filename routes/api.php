<?php

use App\Http\Controllers\ComplaintController;
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
Route::post("store-complaint", [ComplaintController::class, "store"]);
Route::get("retrieve-complaints", [ComplaintController::class, "retrieveComplaints"]);
Route::get("mark-as-resolved/{id}", [ComplaintController::class, "markAsResolved"]);
