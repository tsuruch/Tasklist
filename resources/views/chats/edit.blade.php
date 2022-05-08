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
                        <div class="select_members">
                            <div class="box selecting_members">
                                @foreach ($all_users as $user)
                                    <input type="checkbox" name="members[]" value="{{$user->id}}" {{
                                            in_array($user->id, $in_users, true) ? "checked": ""}}
                                            onclick="Displaymember(event, {{$user->id}})">{{ $user->username}}
                                    <br>
                                @endforeach
                            </div>
                            <div class="box selected">
                                @foreach ($all_users as $user)
                                <div id="{{$user->id}}" class="selected_members" style="display: {{
                                 in_array($user->id, $in_users, true) ? "": "none"}}">{{ $user->username}}</div>
                                @endforeach
                            </div>

                        </div>
                        @error('members')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
            </table>
            <div class="c">
                <input type="submit" value="更新" class="btn" />
            </div>
    </form>
    @if($is_chatgroups_admin)
    <form action="{{ route('chatgroups.destroy', $chatgroup->id) }}" method="post">
        @method('DELETE')
        @csrf
        <div class="c">
            <input type="submit" value="削除" class="btn" />
        </div>
    </form>
    @endif
</x-layout>
