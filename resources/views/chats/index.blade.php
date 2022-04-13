<x-layout>
    <x-slot name="title">
        Chats
    </x-slot>
    <table class="ta1">
        <h3>チャットグループ一覧</h3>
        <a href="{{ route('chatgroups.create') }}">新規チャット作成</a>
        <tr>
            <th class="tamidashi">チャットグループ名</th>
            <th class="tamidashi">作成者</th>
            <th class="tamidashi">最新コメント</th>
            <th class="tamidashi">最新日時</th>
        </tr>
        @foreach ($chatgroups as $chatgroup)
        <tr>
            <td>
                <a href="{{ route('chatgroups.show', $chatgroup->chatgroup->id) }}">{{ $chatgroup->chatgroup->name }}</a>
                @if ($chatgroup->chatgroup->user->id === session('user_id'))
                    <a href="{{ route('chatgroups.edit', $chatgroup->chatgroup->id)}}">グループ編集</a>
                @endif
            </td>
            <td>{{ $chatgroup->chatgroup->user->username }}</td>
            <td>最新コメント</td>
            <td>最新日時</td>
        </tr>
        @endforeach
    </table>
</x-layout>
