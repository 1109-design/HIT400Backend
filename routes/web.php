<?php

use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/home', function () {
//     return view('mushandirapamwe.home');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('mush-dashboard');
Route::get('/view-all-complaints/{category}', [App\Http\Controllers\HomeController::class, 'viewAllComplaints'])->name('mush-view-complaints');
Route::get('/management-reports/locations-overview', [\App\Http\Controllers\HomeController::class, 'locationsOverview'])->name('locations-summary');
Route::post('update-status', [\App\Http\Controllers\HomeController::class, 'updateStatus'])->name('update-status');
Route::get('complaint-location/{id}', [\App\Http\Controllers\HomeController::class, 'complaintLocation'])->name('complaint-location');
Route::get('download-attachment/{id}', [ComplaintController::class, 'downloadAttachment'])->name('download-attachment');
Route::get('update-complaints', [ComplaintController::class, 'updateSentimentAndScore']);
Route::get('complaints-analysis', [ComplaintController::class, 'complaintsAnalysis'])->name('complaints-analysis');
//Route::get('/complaints', [App\Http\Controllers\ComplaintController::class, 'index'])->name('complaints.index');

Route::get('ai-analysis', [ComplaintController::class, 'aiAnalysis'])->name('ai-analysis');
Route::post('/writer/generate', [ComplaintController::class, 'generateAiAnswers']);





