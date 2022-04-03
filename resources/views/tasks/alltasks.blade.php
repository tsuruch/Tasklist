<x-layout>
    <x-slot name="title">
        All Tasks
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
        @foreach ($tasks as $task)
        <tr>
            <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
            <td>{{ $task->deadline }}</td>
            <td>1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        @endforeach
    </table>
</x-layout>
