<x-layout>
    <x-slot name="title">
        {{ $task->name }}更新
    </x-slot>
    <form action="{{ route('tasks.update', $task) }}" method="post" class="form-group">
        @method('PATCH')
        @csrf

        <ul>
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
            <li>
                <label>
                    タスク名
                    <input type="text" name="name" value="{{ old('name', $task->name) }}">
                </label>
            </li>
            @error('deadline')
            <div class="error">{{ $message }}</div>
            @enderror
            <li>
                <label>
                    締め切り
                    <input type="date" name="deadline" value="{{ old('deadline', $task->deadline) }}">
                </label>
            </li>
        </ul>
        <button>追加</button>
    </form>
</x-layout>
