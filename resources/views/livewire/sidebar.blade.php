<div wire:poll.10s>
{{--    @dd($chats)--}}
    @forelse($chats as $chat)
        @if($chat->type == 'private')
        <div class="open-chat chat-container-{{$chat->id}}" wire:click="selectChat({{$chat->id}})">
            <div class="chat-bar-{{$chat->id}}">
                <h5>{{ $chat->them()->name }}</h5>
            </div>
        </div>
        @else
            <div class="open-chat chat-container-{{$chat->id}}" wire:click="selectChat({{$chat->id}})">
                <div class="chat-bar-{{$chat->id}}">
                    <h5>{{ $chat->title }}</h5>
                </div>
            </div>
        @endif
    @empty
    @endforelse
</div>
