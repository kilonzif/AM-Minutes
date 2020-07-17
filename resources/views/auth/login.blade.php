@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    <main class="py-5">
        <div class="app-content container center-layout mt-2">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <section class="flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="col-lg-6 col-md-8 col-sm-10 col-10 p-0 p-lg-4 p-md-2 p-sm-0" style="padding-top:1em !important">
                                <div class="card border-grey border-lighten-3 m-0">
                                    <div class="card-header border-0 pb-0">
                                        <div class="card-title text-center">
                                            <div class="p-1 pb-0">
                                                <img src="{{ asset('images/piedpiper_logo.png') }}" alt="branding logo">
                                                <h3 class="analogminute">AnalogMinute</h3>
                                            </div>
                                        </div>
                                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-0">
                                            <span>Login</span>
                                        </h6>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form-horizontal form-simple" action="{{ route('login') }}" method="POST" novalidate>
                                                @csrf
                                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                           name="email" value="{{ old('email') }}" required autocomplete="email"
                                                           placeholder="Your Email" autofocus required>

                                                    <div class="form-control-position">
                                                        <i class="ft-user"></i>
                                                    </div>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset><br>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input id="password" type="password"
                                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                           name="password" placeholder="Enter Password" required autocomplete="current-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <div class="form-control-position">
                                                        <i class="fa fa-key"></i>
                                                    </div>
                                                </fieldset>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-12 text-center text-md-left">
                                                        <fieldset>
                                                            <input type="checkbox" name="remember" id="remember-me" class="chk-remember"
                                                                   id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                                                            <label for="remember-me"> Remember Me</label>
                                                        </fieldset>
                                                    </div>

                                                    @if (Route::has('password.request'))
                                                        <div class="col-md-6 col-12 text-center text-md-right"><a href="{{ route('password.request') }}" class="card-link">Forgot Password?</a></div>
                                                    @endif

                                                </div>
                                                <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('vendors-scripts')
    <script type="text/javascript" src="{{ asset('vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
@endpush

@push('end-scripts')

@endpush
