<?php

namespace App\Providers;

use Exception;
use App\Models\Settings;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $settings = Settings::all();
            // Set all configs from database
            foreach ($settings as $setting) {
                config([$setting->key => $setting->value]);
            }

            //only update config if recaptcha settings have changed in DB
            if (
                config('recaptcha.api_site_key') != config('SETTINGS::RECAPTCHA:SITE_KEY') ||
                config('recaptcha.api_secret_key') != config('SETTINGS::RECAPTCHA:SECRET_KEY')
            ) {
                config(['recaptcha.api_site_key' => config('SETTINGS::RECAPTCHA:SITE_KEY')]);
                config(['recaptcha.api_secret_key' => config('SETTINGS::RECAPTCHA:SECRET_KEY')]);

                Artisan::call('config:clear');
                Artisan::call('cache:clear');
            }

            // Set Mail Config
            //only update config if mail settings have changed in DB
            if (
                config('mail.default') != config('SETTINGS:MAIL:MAILER') ||
                config('mail.mailers.smtp.host') != config('SETTINGS:MAIL:HOST') ||
                config('mail.mailers.smtp.port') != config('SETTINGS:MAIL:PORT') ||
                config('mail.mailers.smtp.username') != config('SETTINGS:MAIL:USERNAME') ||
                config('mail.mailers.smtp.password') != config('SETTINGS:MAIL:PASSWORD') ||
                config('mail.mailers.smtp.encryption') != config('SETTINGS:MAIL:ENCRYPTION') ||
                config('mail.from.address') != config('SETTINGS:MAIL:FROM_ADDRESS') ||
                config('mail.from.name') != config('SETTINGS:MAIL:FROM_NAME')
            ) {
                config(['mail.default' => config('SETTINGS::MAIL:MAILER')]);
                config(['mail.mailers.smtp' => [
                    'transport' => 'smtp',
                    'host' => config('SETTINGS::MAIL:HOST'),
                    'port' => config('SETTINGS::MAIL:PORT'),
                    'encryption' => config('SETTINGS::MAIL:ENCRYPTION'),
                    'username' => config('SETTINGS::MAIL:USERNAME'),
                    'password' => config('SETTINGS::MAIL:PASSWORD'),
                    'timeout' => null,
                    'auth_mode' => null,
                ]]);
                config(['mail.from' => ['address' => config('SETTINGS::MAIL:FROM_ADDRESS'), 'name' => config('SETTINGS::MAIL:FROM_NAME')]]);

                Artisan::call('queue:restart');
            }
        } catch(Exception $e) {
            // error_log('Settings Error: Could not load settings from database. The Installation probably is not done yet.');
            // error_log($e);
        }
    }
}
