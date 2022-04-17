<x-layout>
    <x-slot name="title">
        Edit Chat
    </x-slot>
    <form action="{{ route('chatgroups.update', $chatgroup->id) }}" method="post" class="form-group">
        @method('PATCH')
        @csrf
            <table class="ta1 mb1em">
                <tr>
                    <th>チャットグループ名</th>
                    <td><input type="text" name="name" class="ws" value="{{ old('name', $chatgroup->name)}}">
                        <input type="hidden" name="id" value="{{$chatgroup->id}}">
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>メンバー</th>
                    <td>
                        <div class="box">
                            @foreach ($all_users as $user)
                                <input type="checkbox" name="members[]" value="{{$user->id}}" {{
                                        in_array($user->id, $in_users, true) ? "checked": ""}} >{{ $user->username}}
                                <br>
                            @endforeach
                        </div>
                        @error('members')
                        <div class="error">{{ $message }}</div>
                        @enderror
                        <p>右側にはチェックボックスで選択した人を表示する</p>
                    </td>
                </tr>
            </table>
            <div class="c">
                <input type="submit" value="更新" class="btn" />
            </div>
    </form>
    <form action="{{ route('chatgroups.destroy', $chatgroup->id) }}" method="post">
        @method('DELETE')
        @csrf
        <div class="c">
            <input type="submit" value="削除" class="btn" />
        </div>
    </form>
</x-layout>
