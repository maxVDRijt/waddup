<div wire:poll>
{{--    @dd($chats)--}}
    @forelse($chats as $chat)
        <div class="open-chat chat-container-{{$chat->id}}" wire:click="selectChat({{$chat->id}})">
            <div class="chat-bar-{{$chat->id}}">
                <h5>{{ $chat->them()->name }}</h5>
            </div>
        </div>
    @empty
    @endforelse
</div>
