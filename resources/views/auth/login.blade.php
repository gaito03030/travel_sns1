@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card login_wrap">
                <div class="card-body">
                    <h2 class="card_header">ログイン</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="logo_img">
                            <img src="{{url('img/logo.png')}}">
                            <p>とらべる～と</p>
                        </div>

                        <div class="row mb-3 input_wrap">
                            <label for="email" class="login_label">{{ __('メールアドレス') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control login_input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレスを入力してください">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 input_wrap">
                            <label for="password" class="login_label">{{ __('パスワード') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control login_input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワードを入力してください">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('ログイン状態を保持する') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="login_btn">
                                <button type="submit" class="btn-primary">
                                    {{ __('ログイン') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('パスワードをお忘れですか？') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection