<x-layout>
    <x-slot name="title">
        Chats
    </x-slot>
    <table class="ta1">
        <h3>チャットグループ一覧</h3>
        <a href="{{ route('chatgroups.create') }}">新規チャット作成</a>
        <tr>
            <th class="tamidashi">チャット相手</th>
            <th class="tamidashi">最新コメント</th>
            <th class="tamidashi">最新日時</th>
        </tr>
        @foreach ($chatgroups as $chatgroup)
        <tr>
            <td><a href="{{ route('chatgroups.show', $chatgroup->chatgroup->id) }}">{{ $chatgroup->chatgroup->name }}</a></td>
            <td>最新コメント</td>
            <td>最新日時</td>
        </tr>
        @endforeach
    </table>
</x-layout>
