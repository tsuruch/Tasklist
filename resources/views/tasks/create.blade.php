<x-layout>
    <x-slot name="title">
        タスク追加
    </x-slot>
    <form action="{{ route('tasks.store') }}" method="post" class="form-group">
        @csrf

        <ul>
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
            <li>
                <label>
                    タスク名
                    <input type="text" name="name" value="{{ old('name') }}">
                </label>
            </li>
            @error('deadline')
            <div class="error">{{ $message }}</div>
            @enderror
            <li>
                <label>
                    締め切り
                    <input type="date" name="deadline" value="{{ old('deadline') }}">
                </label>
            </li>
        </ul>
        <button>追加</button>
    </form>
</x-layout>
