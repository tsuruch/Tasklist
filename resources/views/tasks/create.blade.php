<x-layout>
    <x-slot name="title">
        TaskRegist
    </x-slot>
    <form action="{{ route('tasks.store') }}" method="post" class="form-group">
        @csrf
        <div class="table-wrap">
            <table class="ta1 mb1em">
                <tr>
                    <th>タスク名</th>
                    <td><input type="text" name="name" class="ws" value="{{ old('name') }}">
                        @error('name')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>納品日</th>
                    <td><input type="date" name="deadline" value="{{ old('deadline') }}">
                        @error('deadline')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>詳細</th>
                    <td>
                    <textarea id="" cols="30" rows="10" name="detail" class="wl">{{ old('detail') }}</textarea>
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
