<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\V1\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

// Route::middleware(['can:isAdminOrHigher'])->name('/statistiques')->group(function () {
//         Route::prefix('api')->name('api.')->group(function () {
//             Route::apiResource('dashboards', \Jhumanj\LaravelModelStats\Http\Controllers\DashboardController::class);
//             Route::post('widgets/data',
//                 [\Jhumanj\LaravelModelStats\Http\Controllers\StatController::class, 'widgetData']);
//             Route::post('widgets/custom-code/data',
//                 [\Jhumanj\LaravelModelStats\Http\Controllers\CustomCodeController::class, 'widgetData']);

//             Route::post('widgets/custom-code/execute',
//                 [\Jhumanj\LaravelModelStats\Http\Controllers\CustomCodeController::class, 'executeCustomCode']);
//         });

//         Route::get('/{view?}', [\Jhumanj\LaravelModelStats\Http\Controllers\HomeController::class, 'home'])
//             ->name('dashboard')
//             ->where('view', '^(?!api).*$');
//     });


//Per token role based access control
// Route::middleware(['auth:sanctum','can:isAdminOrHigher'])->get('/stats', function (Request $request) {
//     //Route::get('/testPage', function () {
//         return "Test Page";
//     // });
// });
