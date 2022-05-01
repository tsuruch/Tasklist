<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ $title }}-進捗管理アプリ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ここにサイト説明を入れます">
<meta name="keywords" content="キーワード１,キーワード２,キーワード３,キーワード４,キーワード５">
<link rel="stylesheet" href="{{ url('css/style.css') }}">
<link rel="stylesheet" href="{{ url('css/slide.css') }}">
<link rel="stylesheet" href="{{ url('css/fixmenu.css') }}">
<script type="text/javascript" src="{{ url('js/openclose.js') }}"></script>
<script type="text/javascript" src="{{ url('js/fixmenu.js') }}"></script>
<script type="text/javascript" src="{{ url('js/script.js') }}"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<style>
body.is-fixed .nav-fix-pos {position: static !important;top: auto;}
body.is-fixed header {margin-bottom: 0px;}
body.is-fixed #contents {padding-top: 0;}
</style>
<![endif]-->
</head>

<body id="top">

<div id="container">

<header>
<div class="inner">
<h1 id="logo"><a href="{{ route('tasks.index') }}">進捗管理アプリ</a></h1>
<p>{{ session('username', 'ゲスト')}}</p>
<ul id="h-nav">
    @if ($is_auth_admin)
        <a href="{{ route('admin') }}">管理者用ページ</a>
    @endif
    <a href=""></a>
    <form action="{{ route('users.logout') }}" method="post">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</ul>
</div>
</header>

@if (strpos(url()->current(), 'admin')===false)

<!--大きな端末用（901px以上端末）メニュー-->
<div class="nav-fix-pos">
    <nav id="menubar">
    <ul>
    <li class="{{ url()->current() === route('tasks.index')? "current":""}}"><a href="{{ route('tasks.index') }}">HOME</a></li>
    <li class="{{ url()->current() === route('tasks.alltasks')? "current":""}}"><a href="{{ route('tasks.alltasks') }}">ALLSCHEDULE</a></li>
    <li class="{{ url()->current() === route('chatgroups.index')? "current":""}}"><a href="{{ route('chatgroups.index') }}">CHATS</a></li>
    <li class="{{ url()->current() === route('tasks.members')? "current":""}}"><a href="{{ route('tasks.members') }}">MEMBERS</a></li>
    <li class="{{ url()->current() === route('setting')? "current":""}}"><a href="{{ route('setting') }}">SETTING</a></li>
    @if ($is_tasks_admin)
    <li class="{{ url()->current() === route('tasks.create')? "current":""}}"><a href="{{ route('tasks.create') }}">TASKREGIST</a></li>
    @endif
    </ul>
    </nav>
    </div>

    <aside id="mainimg">
    <img src="images/1.jpg" alt="" id="slide0">
    <img src="images/1.jpg" alt="" id="slide1">
    <img src="images/2.jpg" alt="" id="slide2">
    <img src="images/3.jpg" alt="" id="slide3">
    </aside>

    <!--小さな端末用（900px以下端末）メニュー-->
    <nav id="menubar-s">
    <ul>
        <li class="{{ url()->current() === route('tasks.index')? "current":""}}"><a href="{{ route('tasks.index') }}">HOME</a></li>
        <li class="{{ url()->current() === route('tasks.alltasks')? "current":""}}"><a href="{{ route('tasks.alltasks') }}">ALLSCHEDULE</a></li>
        <li class="{{ url()->current() === route('tasks.create')? "current":""}}"><a href="{{ route('tasks.create') }}">TASKREGIST</a></li>
        <li class="{{ url()->current() === route('chatgroups.index')? "current":""}}"><a href="{{ route('chatgroups.index') }}">CHATS</a></li>
        <li class="{{ url()->current() === route('tasks.members')? "current":""}}"><a href="{{ route('tasks.members') }}">MEMBERS</a></li>
        <li class="{{ url()->current() === route('setting')? "current":""}}"><a href="{{ route('setting') }}">SETTING</a></li>
    </ul>
    </nav>
    <div id="contents">

        <div id="main">
            <h2>{{ $title }}</h2>


            {{ $slot }}
        </div>

    <!--/main-->

    <div id="sub">

    <nav>
    <h2 class="bg1">チャット通知</h2>
        <ul class="submenu">
            @if ($chatnotifications->isEmpty())
                <p>現在チャット通知はありません</p>
            @endif
        @foreach ($chatnotifications as $chatnotification)
            @if (!$chatnotification->notificated)
                <form action="{{ route('notification.notificated', 'chats' ) }} " method="post" name="chatnotification{{$chatnotification->id}}">
                    @method('PATCH')
                    @csrf
                    <li><a href="javascript:chatnotification{{$chatnotification->id}}.submit()"><b>{{ $chatnotification->message }}</b></a></li>
                    <input type="hidden" name="notification" value="{{ $chatnotification->id }}">
                </form>
            @else
                <li><a href="{{ route($chatnotification->route, $chatnotification->group_id) }}">{{ $chatnotification->message }}</a></li>
            @endif
        @endforeach
    <h2 class="bg1">タスク通知</h2>
    <ul class="submenu">
        @if ($tasknotifications->isEmpty())
        <p>現在タスク通知はありません</p>
        @endif
    @foreach ($tasknotifications as $tasknotification)
        @if (!$tasknotification->notificated)
            <form action="{{ route('notification.notificated', 'tasks' ) }} " method="post" name="tasknotification{{$tasknotification->id}}">
                @method('PATCH')
                @csrf
                <li><a href="javascript:tasknotification{{$tasknotification->id}}.submit()"><b>{{ $tasknotification->message }}</b></a></li>
                <input type="hidden" name="notification" value="{{ $tasknotification->id }}">
            </form>
        @else
            <li><a href="{{ route($tasknotification->route, $tasknotification->task_id) }}">{{ $tasknotification->message }}</a></li>
        @endif
    @endforeach
    </ul>
    </nav>


    </div>
    <!--/sub-->

    </div>
    <!--/contents-->

    <p id="pagetop"><a href="#">↑</a></p>

    <footer>
    <small>Copyright&copy; <a href="">SAMPLE COMPANY</a> All Rights Reserved.</small>
    <span class="pr">《<a href="http://template-party.com/" target="_blank">Web Design:Template-Party</a>》</span>
    </footer>

    </div>
    <!--/container-->

    <!--お知らせ欄の開閉処理条件　900px以下-->
    <script type="text/javascript">
    if (OCwindowWidth() <= 900) {
        open_close("newinfo_hdr", "newinfo");
    }
    </script>

    <!--メニューの３本バー-->
    <div id="menubar_hdr" class="close"><span></span><span></span><span></span></div>
    <!--メニューの開閉処理条件設定　900px以下-->
    <script type="text/javascript">
    if (OCwindowWidth() <= 900) {
        open_close("menubar_hdr", "menubar-s");
    }
    </script>
    </body>
    </html>





    @else







    <div class="c1" id="contents">

        <div id="main">
            <h2>{{ $title }}</h2>


            {{ $slot }}
        </div>

    <!--/main-->


    <p id="pagetop"><a href="#">↑</a></p>

    <footer>
    <small>Copyright&copy; <a href="">SAMPLE COMPANY</a> All Rights Reserved.</small>
    <span class="pr">《<a href="http://template-party.com/" target="_blank">Web Design:Template-Party</a>》</span>
    </footer>

    </div>
    <!--/container-->

    <!--お知らせ欄の開閉処理条件　900px以下-->
    <script type="text/javascript">
    if (OCwindowWidth() <= 900) {
        open_close("newinfo_hdr", "newinfo");
    }
    </script>

    <!--メニューの３本バー-->
    <div id="menubar_hdr" class="close"><span></span><span></span><span></span></div>
    <!--メニューの開閉処理条件設定　900px以下-->
    <script type="text/javascript">
    if (OCwindowWidth() <= 900) {
        open_close("menubar_hdr", "menubar-s");
    }
    </script>
    </body>
    </html>


    @endif



