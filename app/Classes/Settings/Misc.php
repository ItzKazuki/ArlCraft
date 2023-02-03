<?php

namespace App\Classes\Settings;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class Misc
{
    public function __construct()
    {
        return;
    }

    public function updateSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recaptcha-site-key' => 'nullable|string',
            'recaptcha-secret-key' => 'nullable|string',
            'enable-recaptcha' => 'nullable|string',
            'mailservice' => 'nullable|string',
            'mailhost' => 'nullable|string',
            'mailport' => 'nullable|string',
            'mailusername' => 'nullable|string',
            'mailpassword' => 'nullable|string',
            'mailencryption' => 'nullable|string',
            'mailfromadress' => 'nullable|string',
            'mailfromname' => 'nullable|string',

        ]);

        $validator->after(function ($validator) use ($request) {
            // if enable-recaptcha is true then recaptcha-site-key and recaptcha-secret-key must be set
            if ($request->get('enable-recaptcha') == 'true' && (! $request->get('recaptcha-site-key') || ! $request->get('recaptcha-secret-key'))) {
                $validator->errors()->add('recaptcha-site-key', 'The site key is required if recaptcha is enabled.');
                $validator->errors()->add('recaptcha-secret-key', 'The secret key is required if recaptcha is enabled.');
            }
        });

        if ($validator->fails()) {
            return redirect(route('admin.settings.index').'#misc')->with('error', __('Misc settings have not been updated!'))->withErrors($validator)
                ->withInput();
        }

        $values = [
            'SETTINGS::RECAPTCHA:SITE_KEY' => 'recaptcha-site-key',
            'SETTINGS::RECAPTCHA:SECRET_KEY' => 'recaptcha-secret-key',
            'SETTINGS::RECAPTCHA:ENABLED' => 'enable-recaptcha',
            'SETTINGS::MAIL:MAILER' => 'mailservice',
            'SETTINGS::MAIL:HOST' => 'mailhost',
            'SETTINGS::MAIL:PORT' => 'mailport',
            'SETTINGS::MAIL:USERNAME' => 'mailusername',
            'SETTINGS::MAIL:PASSWORD' => 'mailpassword',
            'SETTINGS::MAIL:ENCRYPTION' => 'mailencryption',
            'SETTINGS::MAIL:FROM_ADDRESS' => 'mailfromadress',
            'SETTINGS::MAIL:FROM_NAME' => 'mailfromname',

        ];

        foreach ($values as $key => $value) {
            $param = $request->get($value);

            Settings::where('key', $key)->updateOrCreate(['key' => $key], ['value' => $param]);
            Cache::forget('setting'.':'.$key);
        }

        return redirect(route('admin.settings.index').'#misc')->with('success', __('Misc settings updated!'));
    }
}