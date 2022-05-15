<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher("2806c3bed490d6f14c78", {
        cluster: "ap3"
        });

        var channel = pusher.subscribe("my-channel");
        channel.bind("my-event", function(data) {
        let chat = data.push_chat;
        /*直近のチャットのIDを取得して、今回反映させるチャットの連番を生成*/
        console.log(document.getElementById("chatlog").children.length);
        /*まだチャットがない時は1を通し番号として挿入*/
        if(document.getElementById("chatlog").children.length == 0) {
            var number = 1;
        }else{
            var number = Number(document.getElementById("chatlog").children[0].id) + 1
        }
        console.log(document.getElementById("chatlog").children[0]);
        let chatlog = document.getElementById("chatlog");
        let table = document.createElement("table");
        let tr1 = document.createElement("tr");
        let tr2 = document.createElement("tr");
        let th = document.createElement("th");
        let th_text = number+"."+chat.created_at+" by " + chat.username;
        let td = document.createElement("td");
        table.setAttribute("class", "ta1");
        table.setAttribute("id", number);
        th.setAttribute("class", "tamidashi");
        th.insertAdjacentHTML("afterbegin", th_text);
        tr1.appendChild(th);
        table.appendChild(tr1);
        td.insertAdjacentHTML("afterbegin", chat.chat);
        tr2.appendChild(td);
        table.appendChild(tr2);
        chatlog.prepend(table);
        });

    </script>
    <x-slot name="title">
        {{ $chatgroup->name }}
        参加者：
        @foreach ($chatgroup_tousers as $chatgroup_touser)
            @foreach ($chatgroup_touser->chatmanages as $chatmanage)
                @if ($loop->index === 4)
                    ...
                    @break
                @endif
                {{ $chatmanage->user->username }}
            @endforeach
        @endforeach

    </x-slot>
    <div id="pusher"></div>
    <form action="{{ route('chats.add', $chatgroup->id) }}" method="post">
        @csrf
        <table class="ta1 mb1em">
            <tr>
                <th>
                    <div class="c">
                    <input type="submit" value="チャット投稿" class="btn" />
                </div>
                </th>
                <td>
                <textarea id="" cols="30" rows="10" name="chat" class="wl"></textarea>
                </td>
            </tr>
        </table>
    </form>
    <div id="chatlog">
        @for ($i = $chats->count()-1; $i>=0; $i--)
        <table class="ta1" id="{{ $i+1 }}">
            <tr>
                <th class="tamidashi">{{ $i+1 }}.{{$chats[$i]->created_at }} by {{$chats[$i]->user->username}}</th>
            </tr>
            <tr>
                <td>{!! nl2br(e($chats[$i]->chat)) !!}</td>
            </tr>
            <tr>
        </table>
        @endfor
    </div>
</x-layout>
