<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <title>-{{ $title }}-進捗管理アプリ</title>
</head>
<body>
    <header>
        <p>ようこそ、〇〇さん!</p>
        <a href="{{ route('tasks.create') }}">追加</a>
        <a href="{{ route('tasks.index') }}">一覧に戻る</a>
    </header>
    <div class="container">
        <h1>{{ $title }}</h1>
{{ $slot }}
</div>
</body>
</html>
