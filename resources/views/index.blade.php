<x-layout>
    <x-slot name="title">
        Home
    </x-slot>
    <table>
        <tr>
            <th>タスク名</th>
            <th>登録日</th>
            <th>納品日</th>
            <th>工程1</th>
            <th>工程2</th>
            <th>工程3</th>
            <th>工程4</th>
            <th>補足事項</th>
        </tr>
        @foreach ($tasks as $task)
        <tr>
            <th><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></th>
            <th>いらんかも</th>
            <th>{{ $task->deadline }}</th>
            <th>1</th>
            <th>0</th>
            <th>0</th>
            <th>0</th>
            <th>補足事項</th>
        </tr>
        @endforeach
    </table>
</x-layout>
