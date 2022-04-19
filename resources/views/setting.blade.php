<x-layout>
    <x-slot name="title">
        Setting※読み専用のものは色付けるとよい？
    </x-slot>
    <h3>個人情報</h3>
    <form action="" method="post" class="form-group">
        @method('PATCH')
        @csrf
        <table class="ta1 mb1em">
            <tr>
                <th>お名前</th>
                <td><input type="text" name="name" class="ws" value="{{ $user->username }}" readonly>
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td><input type="text" name="name" class="ws" value="{{ $user->email }}" readonly>
                </td>
            </tr>
        </table>
        <div class="c">
            <input type="submit" value="送信する" class="btn" />
        </div>
    </form>
    <h3>パスワード変更</h3>
    <form action="" method="post" class="form-group">
        @method('PATCH')
        @csrf
    <table class="ta1 mb1em">
        <tr>
            <th>現在のパスワード</th>
            <td><input type="text" name="name" class="ws" value="">
            </td>
        </tr>
        <tr>
            <th>新しいパスワード</th>
            <td><input type="text" name="name" class="ws" value="">
            </td>
        </tr>
        <tr>
            <th>（確認用）</th>
            <td><input type="text" name="name" class="ws" value="">
            </td>
        </tr>
    </table>
    <div class="c">
        <input type="submit" value="送信する" class="btn" />
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
        <input type="submit" value="送信する" class="btn" />
    </div>
</form>
</x-layout>
