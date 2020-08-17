@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Provide details about your fundraiser') }}</div>

                <div class="card-body">
                    <form method="POST" action="/fundraiser">
                        @csrf
                        <input id="number" type="text" name="number" value="{{ Auth::user()->id }}"required hidden>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name of fundraiser') }}</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="John Doe's Medical bills" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group row">
                            <label for="target" class="col-md-4 col-form-label text-md-right">{{ __('Target Amount') }}</label>
                            <div class="col-md-7">
                                <input id="target" type="text" class="form-control @error('target') is-invalid @enderror" name="target" value="{{ old('target') }}" placeholder="100000" required autofocus>

                                @error('target')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-7">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" placeholder="John Doe was hit by a truck on 27/January/2020 got fractured bones. The money raised will go to offsetting his bill" autofocus>
                                </textarea>
                                @error('idNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Fundraiser') }}
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
