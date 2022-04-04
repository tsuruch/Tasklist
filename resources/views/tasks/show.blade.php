<x-layout>
    <x-slot name="title">
        {{ $task->name }}
    </x-slot>
    <table class="ta1">
        <tr>
            <th class="tamidashi">タスク名</th>
            <th class="tamidashi">納品日</th>
            <th class="tamidashi">工程1</th>
            <th class="tamidashi">工程2</th>
            <th class="tamidashi">工程3</th>
            <th class="tamidashi">工程4</th>
        </tr>
        <tr>
            <td>{{ $task->name }}
                <a href="{{ route('tasks.edit', $task) }}">更新</a>
            </td>
            <td>{{ $task->deadline }}</td>
            <td>{{ $task->process1 }}</td>
            <td>{{ $task->process2 }}</td>
            <td>{{ $task->process3 }}</td>
            <td>{{ $task->process4 }}</td>
        </tr>
    </table>

    <form action="{{ route('mytasks.add', $task) }}" method="post">
        @csrf
        <div class="c">
            <input type="submit" value="My Taskに追加" class="btn" />
        </div>
        <input type="hidden" name="user_id" value="{{ session('user_id') }}">
    </form>


    <form action="{{ route('tasks.destroy', $task) }}" method="post">
        @csrf
        @method('DELETE')
        <div class="c">
            <input type="submit" value="削除" class="btn" />
        </div>
    </form>
    <h3>詳細</h3>
</x-layout>
