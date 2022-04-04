<x-layout>
    <x-slot name="title">
        Home
    </x-slot>
    <h3>My Task</h3>
    <table class="ta1">
        <tr>
            <th class="tamidashi">タスク名</th>
            <th class="tamidashi">納品日</th>
            <th class="tamidashi">工程1</th>
            <th class="tamidashi">工程2</th>
            <th class="tamidashi">工程3</th>
            <th class="tamidashi">工程4</th>
        </tr>
        @foreach ($mytasks as $mytask)
        <tr>
            <td><a href="{{ route('tasks.show', $mytask->task) }}">{{ $mytask->task->name }}</a></td>
            <td>{{ $mytask->task->deadline }}</td>
            <td>{{ $mytask->task->process1 }}</td>
            <td>{{ $mytask->task->process2 }}</td>
            <td>{{ $mytask->task->process3 }}</td>
            <td>{{ $mytask->task->process4 }}</td>
        </tr>
        @endforeach
    </table>
</x-layout>
