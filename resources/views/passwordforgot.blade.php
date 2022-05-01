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
        <h1>パスワードを忘れたら？</h1>
        <h3>登録しているメールアドレスを入力</h3>
        <form action="{{ route('forgotemail') }}" method="post">
            @method('patch')
            @csrf
            <div class="form-item">
                <label for="email"></label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
                @error('email')
                {{ $message }}
                @enderror
            </div>

            <div class="button-panel">
                <input type="submit" class="button" title="メールを送信" value="メールを送信">
            </div>
        </form>
        <div class="form-footer">
          <p><a href="{{ route('users.loginform') }}">Log In</a></p>
        </div>
    </div>
</body>
