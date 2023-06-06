<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\V1\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return redirect('/swagger/#');
});

Auth::routes();


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return "Email verified successfully";
    })->middleware('signed')->name('verification.verify');


    
});

// Per token role based access control
// Route::middleware(['auth:sanctum','can:viewModelStats'])->get('/testPage', function (Request $request) {
    
//     return "Test Page";
//     // Route::get('/testPage', function () {
       
//     // });
// });
