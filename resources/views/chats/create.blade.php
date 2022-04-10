<x-layout>
    <x-slot name="title">
        New Chat
    </x-slot>
    <form action="{{ route('chatgroups.store') }}" method="post" class="form-group">
        @csrf
            <table class="ta1 mb1em">
                <tr>
                    <th>チャットグループ名</th>
                    <td><input type="text" name="name" class="ws" value="">
                    </td>
                </tr>
                <tr>
                    <th>メンバー</th>
                    <td>
                        <div class="box">
                            @foreach ($users as $user)
                                <input type="checkbox" name="members[]" value="{{$user->id}}">{{ $user->username}}
                                <br>
                            @endforeach
                        </div>
                        <p>右側にはチェックボックスで選択した人を表示する</p>
                    </td>
                </tr>
            </table>
            <div class="c">
                <input type="submit" value="作成" class="btn" />
            </div>
    </form>
</x-layout>
