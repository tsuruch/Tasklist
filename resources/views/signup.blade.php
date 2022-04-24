<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="form-wrapper">
        <h1>アカウントを作成する</h1>
        <form action="{{ route('users.signup') }}" method="post">
            @csrf
            <div class="form-item">
                <label for="username"></label>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="名前">
                @error('username')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-item">
                <label for="email"></label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <div class="form-item">
                <label for="password"></label>
                <input type="password" name="password" placeholder="パスワード">
                @error('password')
                {{ $message }}
                @enderror

            </div>
            <div class="form-item">
                <label for="password"></label>
                <input type="password" name="password_confirmation" placeholder="確認用パスワード">
            </div>
            <div class="button-panel">
                <input type="submit" class="button" title="Sign Up" value="Sign Up">
            </div>
        </form>
        <div class="form-footer">
          <p><a href="{{ route('users.loginform') }}">Log In</a></p>
        </div>
    </div>
</body>
