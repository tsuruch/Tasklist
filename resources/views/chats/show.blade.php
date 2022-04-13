<x-layout>
    <x-slot name="title">
        {{ $chatgroup->name }}
        @foreach ($chatgroup_tousers as $chatgroup_touser)
            @foreach ($chatgroup_touser->chatmanages as $chatmanage)
                {{ $chatmanage->user->username }}
            @endforeach
        @endforeach

    </x-slot>
    <form action="{{ route('chats.add', $chatgroup->id) }}" method="post">
        @csrf
        <table class="ta1 mb1em">
            <tr>
                <th>
                    <div class="c">
                    <input type="submit" value="チャット投稿" class="btn" />
                </div>
                </th>
                <td>
                <textarea id="" cols="30" rows="10" name="chat" class="wl"></textarea>
                </td>
            </tr>
        </table>
    </form>
    @foreach ($chats as $chat)
    <table class="ta1">
        <tr>
            <th class="tamidashi">{{ $loop->index+1 }}.{{$chat->created_at }} by {{$chat->user->username}}</th>
        </tr>
        <tr>
            <td>{!! nl2br(e($chat->chat)) !!}</td>
        </tr>
        <tr>
    </table>
    @endforeach

</x-layout>
