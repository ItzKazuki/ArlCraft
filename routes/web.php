<?php

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

Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function () {
    // These routes are defined so that we can continue to reference them programatically.
    // They all route to the same controller function which passes off to Vuejs.
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'auth'])->name('auth.login');

    //oauth
    Route::get('redirect', [SocialiteProviderController::class, 'redirectToProvider'])->name('auth.redirect');
    Route::get('callback', [SocialiteProviderController::class, 'handleProviderCallback'])->name('auth.callback');

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('auth.register');

    Route::get('password/forget', [ForgotPasswordController::class, 'index'])->name('forget.password');
    Route::post('password/forget', [ForgotPasswordController::class, 'store'])->name('auth.forget.password');
    Route::get('password/reset/{token}', [ForgotPasswordController::class, 'reset'])->name('reset.password');
    Route::post('password/reset', [ForgotPasswordController::class, 'resetStore'])->name('auth.reset.password');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'dashboard'], function () {
        // These routes are defined so that we can continue to reference them programatically.
        // They all route to the same controller function which passes off to Vuejs.
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::get('profile', [ProfileController::class, 'index'])->name('dashboard.profile');
        Route::patch('profile/{id}', [ProfileController::class, 'update'])->name('dashboard.profile.post');

        Route::get('notifications', [NotificationController::class, 'index'])->name('dashboard.notification');
        Route::get('notifications/{id}', [NotificationController::class, 'show'])->name('dashboard.notification.show');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        //alreday have name video.(what you want just type php artisan route:list)
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::resource('video', VideoController::class);
        Route::resource('user', UserController::class);
        Route::resource('event', EventController::class);

        Route::group(['prefix' => 'server'], function() {
            Route::get('ban', [ServerRconController::class, 'ban'])->name('ban.index');
            Route::post('ban', [ServerRconController::class, 'banStore'])->name('ban.post');
            Route::get('sendCommand', [ServerRconController::class, 'sendCommand'])->name('send.command.index');
            Route::post('sendCommand', [ServerRconController::class, 'sendCommandStore'])->name('send.command.post');
            Route::get('setRanks', [ServerRconController::class, 'setRanks'])->name('set.ranks.index');
            Route::post('setRanks', [ServerRconController::class, 'setRanksStore'])->name('set.ranks.post');
        });

        Route::get('users.json', [NotificationAdminController::class, 'json'])->name('users.json');
        Route::get('/users/notifications', [NotificationAdminController::class, 'index'])->name('notifications.index');
        Route::post('/users/notifications', [NotificationAdminController::class, 'notify'])->name('notifications.post');
    });
});

Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
