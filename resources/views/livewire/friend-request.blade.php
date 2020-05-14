<div wire:poll>
    @forelse($friendRequests as $request)
        <div class="friend-requests p-3">
            <div class="float-left">
                <h5 class="float-left"><p class="float-left">{{ $request->user_1->username }}</p> wants to be your friend.</h5>
                <div class="options">
                    <p class="btn btn-success" wire:click="requestAccepted({{$request->id}})">Accept</p>
                    <p class="btn btn-danger" wire:click="requestDenied({{$request->id}})">Decline</p>
                </div>
            </div>
        </div>
    @empty
    @endforelse
    <div class="add-friend">
        @if(session()->has('friend_danger'))
            <div class="alert alert-danger">
                    {{ session('friend_danger') }}
            </div>
        @endif
            @if(session()->has('friend_success'))
                <div class="alert alert-success">
                    {{ session('friend_success') }}
                </div>
            @endif
        <form wire:submit.prevent="sendRequest">
            @csrf
            <input type="text" wire:model="requestName">
            <input type="submit" value="add">
        </form>
    </div>
</div>
