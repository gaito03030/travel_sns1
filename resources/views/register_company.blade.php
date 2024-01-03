{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.company') }}">

                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company_flg" class="col-md-4 col-form-label text-md-end">{{ __('Company_flg') }}</label>

                            <div class="col-md-6">
                                <input id="company_flg" type="hidden" name="company_flg" value="0"> 
                            </div>
                        </div>

                     
                        <div class="row mb-0">
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
@endsection --}}

<div class="container mt-4">
    <div class="border p-4">
      <h1 class="h4 mb-4 font-weight-bold">新規作成</h1>
  
      <form action="{{ route('notification.update') }}"  method="POST" id="new">
        @csrf
  
        <fieldset class="mb-4">
  
          <div class="form-group">
            <label for="subject">
              名前
            </label>
            <input
              id="name"
              type="text"
              name="name"
              value=""
              class="form-control"
            >
          </div>
  
          <div class="form-group">
            <label for="subject">
              email
            </label>
            <input
              id="new"
              type="email"
              name="email"
              value=""
              class="form-control"
              rows="8"
            >
            
          </div>
  
          <div class="form-group">
            <label for="subject">
              password
            </label>
            <input
              type="password"
              name="password"
              value=""
              class="form-control"
            >
          </div>
          <button type="submit" class="btn btn-primary">
            register
  
        </fieldset>
      </form>
    </div>
  </div>