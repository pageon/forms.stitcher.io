@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Settings') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="redirect_to" class="col-sm-4 col-form-label text-md-right">{{ __('Success Page') }}</label>

                                <div class="col-md-6">
                                    <input id="redirect_to"
                                           type="text"
                                           class="form-control{{ $errors->has('redirect_to') ? ' is-invalid' : '' }}"
                                           name="redirect_to"
                                           value="{{ old('redirect_to', $user->redirect_to) }}" autofocus>

                                    @if ($errors->has('redirect_to'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('redirect_to') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="throttle_redirect_to" class="col-sm-4 col-form-label text-md-right">{{ __('Error Page') }}</label>

                                <div class="col-md-6">
                                    <input id="throttle_redirect_to"
                                           type="text"
                                           class="form-control{{ $errors->has('throttle_redirect_to') ? ' is-invalid' : '' }}"
                                           name="throttle_redirect_to"
                                           value="{{ old('throttle_redirect_to', $user->throttle_redirect_to) }}">

                                    @if ($errors->has('throttle_redirect_to'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('throttle_redirect_to') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="allowed_site" class="col-sm-4 col-form-label text-md-right">{{ __('Success Page') }}</label>

                                <div class="col-md-6">
                                    <input id="allowed_site"
                                           type="text"
                                           class="form-control{{ $errors->has('allowed_site') ? ' is-invalid' : '' }}"
                                           name="allowed_site"
                                           value="{{ old('allowed_site', $user->allowed_site) }}">

                                    @if ($errors->has('allowed_site'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('allowed_site') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('home') }}">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
