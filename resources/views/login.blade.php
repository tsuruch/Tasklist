<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
    <form action="{{ route('users.login') }}" method="post" class="form-group">
        @csrf

        <table class="ta1 mb1em">
            <tr>
                <th>E-mail</th>
                <td><input type="text" name="email" value="{{ old('email') }}"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="text" name="password">
                </td>
            </tr>
        </table>
        <div class="c">
            <input type="submit" value="送信する" class="btn" />
        </div>
    </form>
