<x-layout>
    <x-slot name="title">
        権限管理
    </x-slot>
    <h3>現在の権限一覧</h3>
    <table class="ta1">
        <tr>
            <th class="tamidashi">ID</th>
            <th class="tamidashi">名前</th>
            <th class="tamidashi">チャットグループ管理権限</th>
            <th class="tamidashi">タスク管理権限</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td id="{{$user->id}}_username">{{ $user->username }}</td>
            <td>
                <form name="chatgroups_admin_form" action="{{ route('admin.update', $user->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="what_admin" value="is_chatgroups_admin">
                    <label for="is_chatgroups_admin">{{ $user->is_chatgroups_admin === 1? "On":"Off"}}</label>
                    <input type="checkbox" name="is_chatgroups_admin" onclick="Admincheck(event)" value="1" {{ $user->is_chatgroups_admin? "checked":"" }}>
                    <input type="button" value="更新する" style="display: None" onclick="Adminsubmit(event, {{ $user->id }}, 'チャットグループ管理権限')">
                </form>
            </td>
            <td>
                <form name="tasks_admin_form" action="{{ route('admin.update', $user->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="what_admin" value="is_tasks_admin">
                    <label for="is_tasks_admin">{{ $user->is_tasks_admin === 1? "On":"Off"}}</label>
                    <input type="checkbox" name="is_tasks_admin" onclick="Admincheck(event)" value="1" {{ $user->is_tasks_admin? "checked":"" }}>
                    <input type="button" value="更新する" style="display: None" onclick="Adminsubmit(event, {{ $user->id }}, 'タスク管理権限')">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</x-layout>
