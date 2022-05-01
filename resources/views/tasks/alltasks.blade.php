<x-layout>
    <x-slot name="title">
        All Tasks !タスクの色は属性に合わせて色々変える
    </x-slot>
    <table class="ta1 mb1em">
        <tr>
            <th>
                検索フィルター
            </th>
            <td>
                <form action="{{ route('tasks.alltasks') }}" method="get" class="form-group">

                    @if ($filtermsg !== "")
                        <label for="filter">{{ $filtermsg }}</label>
                        <a href="{{ route('tasks.alltasks') }}">フィルターを解除</a>
                    @else
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
                    @endif
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
        @foreach($tasks as $task)
        <tr style={{ in_array($task->id, $mytasks, true) ? "background-color:#EFFFFD":""}}>
            <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
            <td>{{ $task->deadline }}</td>
            <td>{{ $task->process1 }}</td>
            <td>{{ $task->process2 }}</td>
            <td>{{ $task->process3 }}</td>
            <td>{{ $task->process4 }}</td>
        </tr>
        @endforeach
    </table>

    {{$tasks->appends($params)->links() }}
</x-layout>
