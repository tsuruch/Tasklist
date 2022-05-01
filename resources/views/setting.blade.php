<x-layout>
    <x-slot name="title">
        Setting※読み専用のものは色付けるとよい？
    </x-slot>
    @php
        $current_path = asset('img')
    @endphp
    <h3>個人情報<img class="keylock" src="{{ asset('img/keylockon.png') }}" alt="" onclick="Lock_onoff(this, '{{ $current_path }}', 'userinfo')"></h3>
    <form action="{{ route('user.update') }}" method="post" class="form-group">
        @method('PATCH')
        @csrf
        <table class="ta1 mb1em">
            <tr>
                <th>お名前</th>
                <td><input type="text" name="username" class="ws userinfo" value="{{ $user->username }}" readonly>
                    @error('username')
                        {{ $message }}
                    @enderror
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td><input type="email" name="email" class="ws userinfo" value="{{ $user->email }}" readonly>
                    @error('email')
                    {{ $message }}
                @enderror
                </td>
            </tr>
        </table>
        <div class="c">
            <input id="userinfobtn" type="hidden" value="変更する" class="btn" />
        </div>
    </form>
    <h3>パスワード変更</h3>
    <form action="{{ route('passwordupdate') }}" method="post" class="form-group">
        @method('PATCH')
        @csrf
    <table class="ta1 mb1em">
        <tr>
            <th>現在のパスワード</th>
            <td><input type="password" name="current_password" class="ws" placeholder="現在のパスワードを入力してください">
                @error('current_password')
                    {{ $message }}
                @enderror
            </td>
        </tr>
        <tr>
            <th>新しいパスワード</th>
            <td><input type="password" name="password" class="ws" placeholder="新しく使うパスワードを入力してください">
                @error('password')
                {{ $message }}
            @enderror
            </td>
        </tr>
        <tr>
            <th>（確認用）</th>
            <td><input type="password" name="password_confirmation" class="ws" placeholder="もう一度新しく使うパスワードを入力してください">
            </td>
        </tr>
    </table>
    <div class="c">
        <input type="submit" value="変更する" class="btn" />
    </div>
</form>
    <h3>その他の設定</h3>
    <form action="{{ route('usersettingupdate') }}" method="post" class="form-group">
        @method('PATCH')
        @csrf
    <table class="ta1 mb1em">
        <tr>
            <th>通知設定</th>
            <td>
                コメント通知<input type="checkbox" name="notifies[]" value="commentnotify" {{ $usersetting->commentnotify? "checked": "" }}>
                チャット通知<input type="checkbox" name="notifies[]" value="chatnotify" {{ $usersetting->chatnotify? "checked": ""}}>
                タスク更新通知<input type="checkbox" name="notifies[]" value="tasknotify" {{ $usersetting->tasknotify? "checked": ""}}>
                チャットグループ追加通知<input type="checkbox" name="notifies[]" value="chatgroupnotify" {{ $usersetting->chatgroupnotify? "checked": ""}}>
            </td>
        </tr>
        <tr>
            <th>一言コメント編集</th>
            <td><input type="text" name="onecomment" class="ws" value="{{ $usersetting->onecomment }}">
            </td>
        </tr>
    </table>
    <div class="c">
        <input type="submit" value="変更する" class="btn" />
    </div>
</form>
</x-layout>
