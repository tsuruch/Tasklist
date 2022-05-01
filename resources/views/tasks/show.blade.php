<x-layout>
    <x-slot name="title">
        {{ $task->name }}
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
        <tr>
            <td>{{ $task->name }}
                <a href="{{ route('tasks.edit', $task) }}">更新</a>
            </td>
            <td>{{ $task->deadline }}</td>
            <td>{{ $task->process1 }}</td>
            <td>{{ $task->process2 }}</td>
            <td>{{ $task->process3 }}</td>
            <td>{{ $task->process4 }}</td>
        </tr>
    </table>


@if (!$mytask_judge)
<form action="{{ route('mytasks.add', $task) }}" method="post">
    @csrf
    <div class="c">
        <input type="submit" value="My Taskに追加" class="btn" />
    </div>
    <input type="hidden" name="user_id" value="{{ session('user_id') }}">
</form>
@else
<form action=" {{ route('mytasks.destroy', $task)}} " method="post">
    @csrf
    @method('DELETE')

    <div class="c">
        <input type="submit" value="My Taskから削除" class="btn" />
    </div>
    <input type="hidden" name="user_id" value="{{ session('user_id') }}">
</form>

@endif

@if ($is_tasks_admin)
<form action="{{ route('tasks.destroy', $task) }}" method="post">
    @csrf
    @method('DELETE')
    <div class="c">
        <input type="submit" value="削除" class="btn" />
    </div>
</form>

@endif
    <h3>詳細</h3>
    <p>{!! nl2br(e($task->detail)) !!}</p>
    <h3>コメント欄</h3>
    <form action="{{ route('comments.store', $task) }}" method="post">
        @csrf
        <table class="ta1 mb1em">
            <tr>
                <th>
                    <div class="c">
                    <input type="submit" value="コメント投稿" class="btn" />
                </div>
                </th>
                <td>
                <textarea id="" cols="30" rows="10" name="comment" class="wl">{{ old('comment') }}</textarea>
                    @error('comment')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>
    </form>
    @foreach ($comments as $comment)
    <table class="ta1">
        <tr>
            <th class="tamidashi">{{ $loop->index+1 }}.{{$comment->created_at }} by {{$comment->user->username}}</th>
        </tr>
        <tr>
            <td>{!! nl2br(e($comment->comment)) !!}</td>
        </tr>
        <tr>
    </table>
    @endforeach
</x-layout>
