@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Provide your details to get started') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="firstName" class="col-md-2 col-form-label text-md-right">{{ __('First Name') }}</label>
                            <div class="col-md-4">
                                <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" placeholder="John" required autocomplete="firstname" autofocus>
                                @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="lastName" class="col-md-2 col-form-label text-md-right">{{ __('Last Name') }}</label>
                            <div class="col-md-4">
                                <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" placeholder="Doe" required autocomplete="lastname" autofocus>

                                @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idNumber" class="col-md-2 col-form-label text-md-right">{{ __('ID Number') }}</label>

                            <div class="col-md-6">
                                <input id="idNumber" type="text" class="form-control @error('idNumber') is-invalid @enderror" name="idNumber" value="{{ old('idNumber') }}" placeholder="24358639" required autocomplete="idnumber" autofocus>

                                @error('idNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="primaryPhone" class="col-md-2 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-4">
                                <input id="primaryPhone" type="text" class="form-control @error('primaryPhone') is-invalid @enderror" name="primaryPhone" value="{{ old('primaryPhone') }}" placeholder="254700987523" required autocomplete="phonenumber" autofocus>
                                @error('primaryPhone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="otherPhone" class="col-md-2 col-form-label text-md-right">{{ __('Other Phone') }}</label>
                            <div class="col-md-4">
                                <input id="otherPhone" type="text" class="form-control @error('otherPhone') is-invalid @enderror" name="otherPhone" value="{{ old('otherPhone') }}" placeholder="254799345876" autocomplete="phonenumber" autofocus>

                                @error('otherPhone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="johndoe@gmail.com" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
