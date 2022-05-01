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
        <h1>パスワードリセット</h1>
        <form action="{{ route('passwordreset.validate') }}" method="post">
            @method('patch')
            @csrf

            <input type="hidden" name="id" value="{{ $record->id }}">
            <div class="form-item">
                <label for="auth_code"></label>
                <input type="number" name="auth_code" placeholder="メール送信時画面に表示された6桁のコード">
                @error('auth_code')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-item">
                <label for="password"></label>
                <input type="password" name="password" placeholder="パスワード" value="">
                @error('password')
                {{ $message }}
                @enderror

            </div>
            <div class="form-item">
                <label for="password"></label>
                <input type="password" name="password_confirmation" placeholder="確認用パスワード">
            </div>
            <div class="button-panel">
                <input type="submit" class="button" title="Password Reset" value="Password Reset">
            </div>
        </form>
        <div class="form-footer">
          <p><a href="{{ route('users.loginform') }}">Log In</a></p>
        </div>
    </div>
</body>
