<div>
{{--    @dd($chat)--}}
    @if($chat != '')
    <div class="chat-container-11" wire:poll="selectChat({{$chat->id}})">
        <div class="chat-header">
            @if($chat->type == 'private')
            {{ $currentChat->them()->name }}
            @else
                {{ $currentChat->title }}
            @endif
        </div>
        <div class="chat-message w-100" onload="updateScroll()">
            @if($messages != '')
            @forelse($messages as $message)
                @if($message->chat_id == $currentChat->id)
                    @if($chat->type == 'private')
                        @if($message->user_id == Auth::user()->id)
                            <div class="w-100 float-right">
                                <div class="send float-right">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @else
                            <div class="w-100 float-left">
                                <div class="get float-left">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @endif
                    @else
                        @if($message->user_id == Auth::user()->id)
                            <div class="w-100 float-right">
                                <div class="send float-right">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @else
                            <div class="w-100 float-left">
                                <div class="get float-left">
                                    <h5> {{ $message->user->name }} :</h5>
                                    {{ $message->message }}
                                </div>
                            </div>
                        @endif
                    @endif
                @endif
            @empty
            @endforelse
            @endif
        </div>
        <div class="chat-form mt-2">
            <form wire:submit.prevent="sendMessage({{$chat->id}})">
                <input type="text" wire:model="text">
                <input value=">" type="submit" class="send-message">
            </form>
        </div>
    </div>
    @endif
</div>
