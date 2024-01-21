@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="card_header">{{ __('新規登録') }}</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3 input_wrap">
                            <label for="name" class="login_label">{{ __('ユーザーネーム') }}</label>

                            <div>
                                <input id="name" type="text" placeholder="ユーザーネームを入力(12文字以内)" pattern=".{1,12}" class="form-control login_input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 input_wrap">
                            <label for="email" class="login_label">{{ __('メールアドレス') }}</label>

                            <div>
                                <input id="email" type="email" placeholder="メールアドレスを入力" class="form-control login_input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" placeholder="パスワードを入力" class="form-control login_input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 input_wrap">
                            <label for="password-confirm" class="login_label">{{ __('パスワード（確認）') }}</label>

                            <div>
                                <input id="password-confirm" type="password" placeholder="パスワードをもう一度入力" class="form-control login_input" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <input id="company_flg" type="hidden" name="company_flg" value="1">
                        <div class="row mb-0">
                            <div class="login_button">
                                <button type="submit" class="btn-primary">
                                    {{ __('登録') }}
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