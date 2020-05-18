<div wire:poll.10s>
{{--    @dd($chats)--}}
    @forelse($chats as $chat)
        @if($chat->type == 'private')
        <div class="open-chat chat-container-{{$chat->id}}" wire:click="selectChat({{$chat->id}})">
            <div class="chat-bar-{{$chat->id}}">
                <img src="{{ $chat->them()->avatar }}" alt="">
                <h5>{{ $chat->them()->name }}</h5>
            </div>
        </div>
        @else
            <div class="open-chat chat-container-{{$chat->id}}" wire:click="selectChat({{$chat->id}})">
                <div class="chat-bar-{{$chat->id}}">
                    <div class="group-avatar">
                        <svg class="glyphicon bi bi-people-fill float-left" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 100-6 3 3 0 000 6zm-5.784 6A2.238 2.238 0 015 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 005 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h5>{{ $chat->title }}</h5>
                </div>
            </div>
        @endif
    @empty
    @endforelse
</div>
