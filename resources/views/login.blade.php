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
        <h1>タスク管理システム</h1>
        <p>このサイトは学習として個人が作成したサイトです!!!</p>
        @if (isset($message))
            <p>メールアドレスまたはパスワードが一致しません</p>
        @else
            <br>
        @endif
        <form action="{{ route('users.login') }}" method="post">
            @csrf
          <div class="form-item">
            <label for="email"></label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
          </div>
          <div class="form-item">
            <label for="password"></label>
            <input type="password" name="password" placeholder="パスワード">
          </div>
          <div class="button-panel">
            <input type="submit" class="button" title="Log In" value="Log In">
          </div>
        </form>
        <div class="form-footer">
          <p><a href="{{ route('users.signupform') }}">アカウントを作成する</a></p>
          <p><a href="{{ route('passwordforgot') }}">パスワードを忘れたら？?</a></p>
        </div>
      </div>
</body>
