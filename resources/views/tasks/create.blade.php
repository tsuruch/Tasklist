<x-layout>
    <x-slot name="title">
        TaskRegist
    </x-slot>
    <form action="{{ route('tasks.store') }}" method="post" class="form-group">
        @csrf
            <table class="ta1 mb1em">
                <tr>
                    <th>タスク名</th>
                    <td><input type="text" name="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>締め切り</th>
                    <td><input type="date" name="deadline" value="{{ old('deadline') }}">
                        @error('deadline')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
            </table>
            <div class="c">
                <input type="submit" value="送信する" class="btn" />
            </div>
    </form>
</x-layout>
