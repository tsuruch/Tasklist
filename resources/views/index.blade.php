<x-layout>
    <x-slot name="title">
        Home
    </x-slot>
    @php
        $current_path = asset('img')
    @endphp
    <h3>My Task<img class="keylock" src="{{ asset('img/keylockon.png') }}" alt="" onclick="Lock_onoff_mytasks(this, '{{ $current_path }}', 'processes')"></h3>
    <table class="ta1">
        <tr>
            <th class="tamidashi">タスク名</th>
            <th class="tamidashi">納品日</th>
            <th class="tamidashi">工程1</th>
            <th class="tamidashi">工程2</th>
            <th class="tamidashi">工程3</th>
            <th class="tamidashi">工程4</th>
        </tr>
        <form name="mytasks_form" action="{{ route('tasks.processupdate') }}" method="post">
            @csrf
            @method('PATCH')
            <input id="taskid_processname" type="hidden" name="taskid_processname" value="">
            <input id="input_value" type="hidden" name="input_value" value="">
            @foreach ($mytasks as $mytask)
            <tr style="background-color:#EFFFFD">
                <td><a href="{{ route('tasks.show', $mytask->task) }}">{{ $mytask->task->name }}</a></td>
                <td >{{ $mytask->task->deadline }}</td>
                <td class="mytasks processes" id="{{ $mytask->task->id}}_process1" contenteditable="false">{{ $mytask->task->process1 }}</td>
                <td class="mytasks processes" id="{{ $mytask->task->id}}_process1" contenteditable="false">{{ $mytask->task->process2 }}</td>
                <td class="mytasks processes" id="{{ $mytask->task->id}}_process1" contenteditable="false">{{ $mytask->task->process3 }}</td>
                <td class="mytasks processes" id="{{ $mytask->task->id}}_process1" contenteditable="false">{{ $mytask->task->process4 }}</td>
            </tr>
            @endforeach

        </form>
    </table>
</x-layout>
