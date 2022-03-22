@extends('layouts.admin')
@section('container')
<div class="row">
    <div class="col-lg-12 px-0">
        @if (true)
            <div class="alert alert-warning p-2 m-2">
                <h5><i class="icon fas fa-exclamation-circle"></i> 
                    Required Email verification!
                </h5>
                You have not yet verified your email address
                <a class="text-primary"
                    href="#">Click here to resend verification email</a>
                <br>
                Please contact support If you didnt receive your verification email.

            </div>
        @endif
        @include('partials.success')
        @include('partials.error')
    </div>
</div>


<form class="form" action="{{ route('dashboard.profile.post', Auth::user()->id) }}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-body">
            <div class="e-profile">
                <div class="row">
                    <div class="col-12 col-sm-auto mb-4">
                        <img class="rounded-circle border-secondary border text-gray-dark" style="width: 140px;height:140px; cursor: pointer" src="{{ $user->getAvatar() }}" alt="avatar">
                    </div>
                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $user->name }}</h4>
                            <p class="mb-0">{{ $user->email }}
                                @if (false)
                                    <i data-toggle="popover" data-trigger="hover" data-content="Verified"
                                        class="text-success fas fa-check-circle">
                                    </i>
                                @else
                                    <i data-toggle="popover" data-trigger="hover" data-content="Not verified"
                                        class="text-danger fas fa-exclamation-circle">
                                    </i>
                                @endif

                            </p>
                        </div>

                        <div class="text-center text-sm-right"><span
                                class="badge badge-{{ $user->isAdmin ? 'danger' : 'primary' }}">{{ $user->isAdmin ? 'admin' : 'user'}}</span>
                            <div class="text-muted">
                                <small>{{ $user->created_at->isoFormat('LL') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="tab-content pt-3">
                    <div class="tab-pane active">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input
                                                class="form-control @error('name') is-invalid @enderror"
                                                type="text" name="name"
                                                value="{{ $user->name }}">

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input
                                                class="form-control @error('username') is-invalid @enderror"
                                                type="text" name="username"
                                                value="{{ $user->username }}">

                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input
                                                class="form-control @error('email') is-invalid @enderror"
                                                type="text" name="email"
                                                value="{{ $user->email }}">

                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="mb-3"><b>Change Password</b></div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input
                                                class="form-control @error('current_password') is-invalid @enderror"
                                                name="current_password" type="password" placeholder="••••••">

                                            @error('current_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                name="new_password" type="password" placeholder="••••••">

                                            @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input
                                                class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                name="new_password_confirmation" type="password"
                                                placeholder="••••••">

                                            @error('new_password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-primary"
                                    type="submit">Save Changes</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection