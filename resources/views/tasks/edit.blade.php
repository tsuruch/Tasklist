<x-layout>
    <x-slot name="title">
        {{ $task->name }}更新
    </x-slot>
    <form action="{{ route('tasks.update', $task) }}" method="post" class="form-group">
        @method('PATCH')
        @csrf
        <div class="table-wrap">
            <table class="ta1 mb1em">
                <tr>
                    <th>タスク名</th>
                    <td><input type="text" name="name" class="ws" value="{{ old('name', $task->name) }}">
                        @error('name')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>締め切り</th>
                    <td><input type="date" name="deadline" value="{{ old('deadline', $task->deadline) }}">
                        @error('deadline')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>工程1</th>
                    <td><input type="text" name="process1" value="{{ old('process1', $task->process1) }}">
                    </td>
                </tr>
                <tr>
                    <th>工程2</th>
                    <td><input type="text" name="process2" value="{{ old('process2', $task->process2) }}">
                    </td>
                </tr>
                <tr>
                    <th>工程3</th>
                    <td><input type="text" name="process3" value="{{ old('process3', $task->process3) }}">
                    </td>
                </tr>
                <tr>
                    <th>工程4</th>
                    <td><input type="text" name="process4" value="{{ old('process4', $task->process4) }}">
                    </td>
                </tr>
                <tr>
                    <th>詳細</th>
                    <td>
                    <textarea id="" cols="30" rows="10" name="detail" class="wl">{{ old('detail', $task->detail) }}</textarea>
                        @error('detail')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
            </table>

        </div>
        <div class="c">
            <input type="submit" value="送信する" class="btn" />
        </div>
    </form>
</x-layout>
