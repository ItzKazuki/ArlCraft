<div class="tab-pane mt-3" id="system">
    <form method="POST" enctype="multipart/form-data" class="mb-3"
        action="{{ route('admin.settings.update.miscsettings') }}">
        @csrf
        @method('PATCH')

        <div class="row">

            {{-- E-Mail --}}
            <div class="col-md-3 px-3">
                <div class="row mb-2">
                    <div class="col text-center">
                        <h1>E-Mail</h1>
                    </div>
                </div>

                <div class="custom-control mb-3 p-0">
                    <label for="mailservice">{{ __('Mail Service') }}:
                        <i data-toggle="popover" data-trigger="hover"
                            data-content="{{ __('The Mailer to send e-mails with') }}" class="fas fa-info-circle"></i>
                    </label>
                    <select id="mailservice" style="width:100%" class="custom-select" name="mailservice" required
                        autocomplete="off" @error('mailservice') is-invalid @enderror>
                        @foreach (array_keys(config('mail.mailers')) as $mailer)
                            <option value="{{ $mailer }}" @if (config('SETTINGS::MAIL:MAILER') == $mailer) selected
                        @endif>{{ __($mailer) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <div class="custom-control p-0">
                        <label for="mailhost">{{ __('Mail Host') }}:</label>
                        <input x-model="mailhost" id="mailhost" name="mailhost" type="text"
                            value="{{ config('SETTINGS::MAIL:HOST') }}"
                            class="form-control @error('mailhost') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="custom-control p-0">
                        <label for="mailport">{{ __('Mail Port') }}:</label>
                        <input x-model="mailhost" id="mailport" name="mailport" type="text"
                            value="{{ config('SETTINGS::MAIL:PORT') }}"
                            class="form-control @error('mailport') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="custom-control p-0">
                        <label for="mailusername">{{ __('Mail Username') }}:</label>
                        <input x-model="mailusername" id="mailusername" name="mailusername" type="text"
                            value="{{ config('SETTINGS::MAIL:USERNAME') }}"
                            class="form-control @error('mailusername') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="custom-control p-0">
                        <label for="mailpassword">{{ __('Mail Password') }}:</label>
                        <input x-model="mailpassword" id="mailpassword" name="mailpassword" type="password"
                            value="{{ config('SETTINGS::MAIL:PASSWORD') }}"
                            class="form-control @error('mailpassword') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="custom-control p-0">
                        <label for="mailencryption">{{ __('Mail Encryption') }}:</label>
                        <input x-model="mailencryption" id="mailencryption" name="mailencryption" type="text"
                            value="{{ config('SETTINGS::MAIL:ENCRYPTION') }}"
                            class="form-control @error('mailencryption') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="custom-control p-0">
                        <label for="mailfromadress">{{ __('Mail From Adress') }}:</label>
                        <input x-model="mailfromadress" id="mailfromadress" name="mailfromadress" type="text"
                            value="{{ config('SETTINGS::MAIL:FROM_ADDRESS') }}"
                            class="form-control @error('mailfromadress') is-invalid @enderror">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="custom-control p-0">
                        <label for="mailfromname">{{ __('Mail From Name') }}:</label>
                        <input x-model="mailfromname" id="mailfromname" name="mailfromname" type="text"
                            value="{{ config('SETTINGS::MAIL:FROM_NAME') }}"
                            class="form-control @error('mailfromname') is-invalid @enderror">
                    </div>
                </div>
            </div>
            <div class="col-md-3 px-3">
                <div class="row mb-2">
                    <div class="col text-center">
                        <h1>ReCaptcha</h1>
                    </div>
                </div>

                <div class="custom-control mb-3 p-0">
                    <div class="col m-0 p-0 d-flex justify-content-between align-items-center">
                        <div>
                            <input value="true" id="enable-recaptcha" name="enable-recaptcha"
                                {{ config('SETTINGS::RECAPTCHA:ENABLED') == 'true' ? 'checked' : '' }}
                                type="checkbox">
                            <label for="enable-recaptcha">{{ __('Enable ReCaptcha') }} </label>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="custom-control p-0">
                        <label for="recaptcha-site-key">{{ __('ReCaptcha Site-Key') }}:</label>
                        <input x-model="recaptcha-site-key" id="recaptcha-site-key" name="recaptcha-site-key"
                            type="text" value="{{ config('SETTINGS::RECAPTCHA:SITE_KEY') }}"
                            class="form-control @error('recaptcha-site-key') is-invalid @enderror">
                        @error('recaptcha-site-key')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="custom-control p-0">
                        <label for="recaptcha-secret-key">{{ __('ReCaptcha Secret-Key') }}:</label>
                        <input x-model="recaptcha-secret-key" id="recaptcha-secret-key" name="recaptcha-secret-key"
                            type="text" value="{{ config('SETTINGS::RECAPTCHA:SECRET_KEY') }}"
                            class="form-control @error('recaptcha-secret-key') is-invalid @enderror">
                        @error('recaptcha-secret-key')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                         @enderror
                    </div>
                </div>
                @if(config('SETTINGS::RECAPTCHA:ENABLED') == 'true')
                <div class="form-group mb-3">
                    <div class="custom-control p-0" style="transform:scale(0.77); transform-origin:0 0;">
                        <label style="font-size: 1.3rem;">{{ __('Your Recaptcha') }}:</label>
                        {!! NoCaptcha::display() !!}
                    </div>
                </div>
                    @endif

            </div>

        </div>
        <div class="row">
            <button class="btn btn-primary mt-3 ml-3">{{ __('Submit') }}</button>
        </div>
    </form>
</div>