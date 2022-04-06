<x-layout>
    <x-slot name="title">
        All Tasks
    </x-slot>
    <table class="ta1 mb1em">
        <tr>
            <th>
                検索フィルター
            </th>
            <td>
                <form action="{{ route('tasks.alltasks') }}" method="get" class="form-group">
                    <ul>
                        <li><input type="text" name="filter"></li>
                        <li>
                            <input type="checkbox" name="columns[]" value="name">タスク名
                            <input type="checkbox" name="columns[]" value="deadline">納品日
                            <input type="checkbox" name="columns[]" value="process1">工程1
                            <input type="checkbox" name="columns[]" value="process2">工程2
                            <input type="checkbox" name="columns[]" value="process3">工程3
                            <input type="checkbox" name="columns[]" value="process4">工程4
                        </li>
                    </ul>
                    @if ($filtermsg !== "")
                        <label for="filter">{{ $filtermsg }}</label>
                        <a href="{{ route('tasks.alltasks') }}">フィルターを解除</a>
                    @endif
                </form>
            </td>
        </tr>
        <tr>
            <th>項目ソート</th>
            <td>
                    <form action="" method="get" class="form-group">
                    <label for="name">タスク名</label>
                    <input type="radio" name="" id="name">
                    <label for="deadline">納品日</label>
                    <input type="radio" name="" id="deadline">
                </form>
            </td>
        </tr>
        </table>
    <table class="ta1">
        <tr>
            <th class="tamidashi">タスク名</th>
            <th class="tamidashi">納品日</th>
            <th class="tamidashi">工程1</th>
            <th class="tamidashi">工程2</th>
            <th class="tamidashi">工程3</th>
            <th class="tamidashi">工程4</th>
        </tr>
        @foreach ($tasks as $task)
        <tr>
            <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
            <td>{{ $task->deadline }}</td>
            <td>{{ $task->process1 }}</td>
            <td>{{ $task->process2 }}</td>
            <td>{{ $task->process3 }}</td>
            <td>{{ $task->process4 }}</td>
        </tr>
        @endforeach
    </table>
</x-layout>
