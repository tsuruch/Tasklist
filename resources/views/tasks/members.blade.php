<x-layout>
    <x-slot name="title">
        Members
    </x-slot>
    <table class="ta1">
        <tr>
            <th class="tamidashi">名前</th>
            <th class="tamidashi">アドレス</th>
            <th class="tamidashi">一言コメント</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->usersetting->onecomment }}</td>
        </tr>
        @endforeach
    </table>
</x-layout>
