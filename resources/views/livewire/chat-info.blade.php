<div>
    @if($chat->type == 'group')
        <div class="group-info">
            <h2>{{ $chat->title }}</h2>
        </div>
        <h5>Group members:</h5>
        @forelse($chat->them() as $user)
            <div class="user-list-item float-left">
                <div class="users-profile-avatar float-left">
                    <img src="{{ $user->avatar }}" alt="user avatar">
                </div>
                <div class="users-profile-data">
                    <h5>{{ $user->name }}</h5>
                </div>
            </div>
        @empty
        @endforelse
    @else
        <div class="user-profile-avatar">
            <img src="{{ $chat->them()->avatar }}" alt="">
        </div>
        <div class="user-profile-data">
            <h3>{{ $chat->them()->name }}</h3>
            <h5>{{ $chat->them()->username }}</h5>
        </div>
    @endif
</div>
