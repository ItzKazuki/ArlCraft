<?php

use App\Classes\Settings\System;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\SocialiteProviderController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Admin\NotificationAdminController;
use App\Http\Controllers\Admin\ServerRconController;

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

// Route::get('artisan/cmd/migration', function () {
//     Artisan::call('migrate', ['--force' => true ]);
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('store', [HomeController::class, 'store'])->name('store');
Route::get('vote', [HomeController::class, 'vote'])->name('vote');
Route::get('event', [HomeController::class, 'event'])->name('event');
Route::get('video', [HomeController::class, 'video'])->name('video');
Route::get('link', [HomeController::class, 'link'])->name('link');

Route::prefix('auth')->name('auth.')->middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'auth'])->name('login.store');

    //oauth
    Route::get('redirect/google', [SocialiteProviderController::class, 'googleRedirect'])->name('redirect.google');
    Route::get('callback/google', [SocialiteProviderController::class, 'handleGoogleCallback'])->name('callback.google');

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('password/forgot', [ForgotPasswordController::class, 'index'])->name('forgot.password');
    Route::post('password/forgot', [ForgotPasswordController::class, 'store'])->name('forgot.password.store');
    Route::get('password/reset/{token}', [ForgotPasswordController::class, 'reset'])->name('reset.password');
    Route::post('password/reset', [ForgotPasswordController::class, 'resetStore'])->name('reset.password.store');
});

Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    // These routes are defined so that we can continue to reference them programatically.
    // They all route to the same controller function which passes off to Vuejs.
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('profile/{id}', [ProfileController::class, 'update'])->name('profile.post');

    Route::get('notifications', [NotificationController::class, 'index'])->name('notification');
    Route::get('notifications/{id}', [NotificationController::class, 'show'])->name('notification.show');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('video', VideoController::class); //admin.video
    Route::resource('user', UserController::class); //admin.user
    Route::resource('event', EventController::class); //admin.event

    //buat notification
    Route::get('users.json', [NotificationAdminController::class, 'json'])->name('users.json');
    Route::get('users/notifications', [NotificationAdminController::class, 'index'])->name('notifications');
    Route::post('users/notifications', [NotificationAdminController::class, 'notify'])->name('notifications.store');

    //server
    Route::prefix('server')->name('server.')->group(function () {
        //get
        Route::get('ban', [ServerRconController::class, 'ban'])->name('ban');
        Route::get('sendCommand', [ServerRconController::class, 'sendCommand'])->name('sendCommand');
        Route::get('setRanks', [ServerRconController::class, 'setRanks'])->name('setRanks');
        
        //post
        Route::post('ban', [ServerRconController::class, 'banStore'])->name('ban.store');
        Route::post('sendCommand', [ServerRconController::class, 'sendCommandStore'])->name('sendCommand.store');
        Route::post('setRanks', [ServerRconController::class, 'setRanksStore'])->name('setRanks.store');
    });

    //settings
    Route::get('settings/datatable', [SettingsController::class, 'datatable'])->name('settings.datatable');
    Route::patch('settings/updatevalue', [SettingsController::class, 'updatevalue'])->name('settings.updatevalue');
    Route::redirect('settings#system', 'system')->name('settings.system');

    //settings
    Route::patch('settings/update/system', [System::class, 'updateSettings'])->name('settings.update.systemsettings');
    Route::patch('settings/update/misc', [System::class, 'updateSettings'])->name('settings.update.miscsettings');
    Route::resource('settings', SettingsController::class)->only('index');
});

Route::post('logout', [LoginController::class, 'logout'])->name('user.logout');
