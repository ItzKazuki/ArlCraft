<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::firstOrCreate([
            'key'   => 'SETTINGS::RECAPTCHA:SITE_KEY',
        ], [
            'value' => env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI'),
            'type'  => 'string',
            'description'  => 'Google Recaptcha API Credentials - https://www.google.com/recaptcha/admin - reCaptcha V2 (not v3)'
        ]);

        Settings::firstOrCreate([
            'key'   => 'SETTINGS::RECAPTCHA:SECRET_KEY',
        ], [
            'value' => env('RECAPTCHA_SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'),
            'type'  => 'string',
            'description'  => 'Google Recaptcha API Credentials - https://www.google.com/recaptcha/admin - reCaptcha V2 (not v3)'
        ]);
        Settings::firstOrCreate([
            'key'   => 'SETTINGS::RECAPTCHA:ENABLED',
        ], [
            'value' => 'true',
            'type'  => 'boolean',
            'description'  => 'Enables or disables the ReCaptcha feature on the registration/login page'

        ]);
        Settings::firstOrCreate([
            'key'   => 'SETTINGS::MAIL:MAILER',
        ], [
            'value' => env('MAIL_MAILER', 'smtp'),
            'type'  => 'string',
            'description'  => 'Selected Mailer (smtp, mailgun, sendgrid, mailtrap)'
        ]);
        Settings::firstOrCreate([
            'key'   => 'SETTINGS::MAIL:HOST',
        ], [
            'value' => env('MAIL_HOST', 'localhost'),
            'type'  => 'string',
            'description'  => 'Mailer Host Adress'
        ]);
        Settings::firstOrCreate([
            'key'   => 'SETTINGS::MAIL:PORT',
        ], [
            'value' =>  env('MAIL_PORT', '25'),
            'type'  => 'string',
            'description'  => 'Mailer Server Port'
        ]);
        Settings::firstOrCreate([
            'key'   => 'SETTINGS::MAIL:USERNAME',
        ], [
            'value' =>  env('MAIL_USERNAME', ''),
            'type'  => 'string',
            'description'  => 'Mailer Username'
        ]);
        Settings::firstOrCreate([
            'key'   => 'SETTINGS::MAIL:PASSWORD',
        ], [
            'value' =>  env('MAIL_PASSWORD', ''),
            'type'  => 'string',
            'description'  => 'Mailer Password'
        ]);
        Settings::firstOrCreate([
            'key'   => 'SETTINGS::MAIL:ENCRYPTION',
        ], [
            'value' =>  env('MAIL_ENCRYPTION', 'tls'),
            'type'  => 'string',
            'description'  => 'Mailer Encryption (tls, ssl)'
        ]);
        Settings::firstOrCreate([
            'key'   => 'SETTINGS::MAIL:FROM_ADDRESS',
        ], [
            'value' =>  env('MAIL_FROM_ADDRESS', ''),
            'type'  => 'string',
            'description'  => 'Mailer From Address'
        ]);
        Settings::firstOrCreate([
            'key'   => 'SETTINGS::MAIL:FROM_NAME',
        ], [
            'value' => env('APP_NAME', 'Controlpanel'),
            'type'  => 'string',
            'description'  => 'Mailer From Name'
        ]);
    }
}
