<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Utilisateur;
use Illuminate\Auth\Events\Registered;

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

#region Test 
Route::get('/send-test-email', function () {
    Mail::to('test@example.com')->send(new RegistrationMail());
    return 'A test email has been sent to test@example.com';
});

Route::get('/test-registered-event', function () {
    $user = Utilisateur::first();  // get the first user as a test
    if ($user) {
        event(new Registered($user));
        return 'Registered event has been dispatched for the first user';
    } else {
        return 'No users found in the database';
    }
});

Route::get('/test-mail', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('vic.gombert@gmail.com');
        $message->subject('Test Email');
    });

    return 'Test email sent';
});
#endregion

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
});