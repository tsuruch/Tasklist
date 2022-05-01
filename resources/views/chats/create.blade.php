<x-layout>
    <x-slot name="title">
        New Chat
    </x-slot>
    <form action="{{ route('chatgroups.store') }}" method="post" class="form-group">
        @csrf
            <table class="ta1 mb1em">
                <tr>
                    <th>チャットグループ名</th>
                    <td><input type="text" name="name" class="ws" value="{{ old('name') }}">
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>メンバー</th>
                    <td>
                        <div class="box">
                            @foreach ($users as $user)
                                <input type="checkbox" name="members[]" value="{{$user->id}}" onclick="Displaymember(event, {{$user->id}})">{{ $user->username}}
                                <br>
                            @endforeach
                        </div>
                        @error('members')
                        <div class="error">{{ $message }}</div>
                        @enderror
                        @foreach ($users as $user)
                        <span id="{{$user->id}}" style="display: none">{{ $user->username}}</span>
                    @endforeach
                    </td>
                </tr>
            </table>
            <div class="c">
                <input type="submit" value="作成" class="btn" />
            </div>
    </form>
</x-layout>
