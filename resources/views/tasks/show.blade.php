<x-layout>
    <x-slot name="title">
        {{ $task->name }}
    </x-slot>
    <a href="{{ route('tasks.edit', $task) }}">更新</a>
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
        <tr>
            <th>{{ $task->name }}</th>
            <th>いらんかも</th>
            <th>{{ $task->deadline }}</th>
            <th>1</th>
            <th>0</th>
            <th>0</th>
            <th>0</th>
            <th>補足事項</th>
            <th>
                <form action="{{ route('tasks.destroy', $task) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button>削除</button>
                </form>
            </th>
        </tr>
    </table>
    <h2>詳細</h2>
</x-layout>
