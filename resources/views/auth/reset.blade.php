@extends('layouts.auth')
@section('content')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Confrim Reset Password</h1>
                        <p class="mb-4">For {{ $email }}</p>
                    </div>
                    <form class="user" action="{{ route('auth.reset.password.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" placeholder="New Password" class="form-control mt-2 @error('new_password') is-invalid @enderror" name="new_password" id="new_password" required>
                                @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="password" placeholder="Password Confirmation" class="form-control mt-2 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" required>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection