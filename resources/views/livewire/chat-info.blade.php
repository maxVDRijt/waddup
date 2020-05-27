<div wire:poll.10s>
    @if($chat->type == 'group')
        <div class="group-info">
            <h2>{{ $chat->title }}</h2>
        </div>
        <h5>Group members:</h5>
        @forelse($chat->them() as $user)
            <div class="user-list-item float-left w-100">
                <div class="dropleft w-100">
                    <button type="button" class="btn p-0 w-100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="users-profile-avatar float-left">
                            <img src="{{ $user->avatar }}" alt="user avatar">
                        </div>
                        <div class="users-profile-data">
                            <h5>{{ $user->name }} <p>{{ $user->username }}</p></h5>
                            @if($user->setChatRoleAttribute() == 'true')
                                    <p class="admin-icon"><i class="fas fa-crown"></i></p>
                            @endif
                        </div>
                    </button>
                    @if(Auth::user()->setChatRoleAttribute() == 'true')
                    <div class="dropdown-menu menu-group-user-show-options">
                        @if($user->setChatRoleAttribute() == 'false')
                            <button class="dropdown-item" type="button" wire:click="chooseAdmin({{$user->id}})">Make admin <i class="fas fa-crown pl-1"></i></button>
                        @else
                            <button class="dropdown-item" type="button" wire:click="clearAdmin({{$user->id}})">remove admin <i class="fas fa-user-times pl-1"></i></button>
                        @endif
                        <button class="dropdown-item" type="button" wire:click="kickUser({{$user->id}})">Remove from group <i class="fas fa-trash-alt pl-1"></i></button>
                    </div>
                    @endif
                </div>
            </div>
        @empty
        @endforelse
        <div class="user-list-item float-left w-100 your-own-info">
            <div class="users-profile-avatar float-left">
                <img src="{{ Auth::user()->avatar }}" alt="user avatar">
            </div>
            <div class="users-profile-data">
                <h5>{{ Auth::user()->name }} <p>(You)</p></h5>
            </div>
            <div class="group-role-user">
                @if(Auth::user()->setChatRoleAttribute() == 'true')
                    <p class="admin-icon" style="right: 5px;"><i class="fas fa-crown"></i></p>
                @endif
            </div>
        </div>
        @if(Auth::user()->setChatRoleAttribute() == 'true')
            <div class="mt-2 float-left">
                <div class="user-list-item float-left admin-add-users" data-toggle="modal" data-target="#addGroupModal">
                    <div class="users-profile-avatar float-left">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="users-profile-data">
                        <h5>Add new members</h5>
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-2 float-left" wire:click="leaveFromGroup({{$chat->id}})">
            @if(session()->has('leave_danger'))
                <div class="alert alert-danger">
                    {{ session('leave_danger') }}
                </div>
            @endif
            <div class="user-list-item float-left admin-add-users">
                <div class="users-profile-avatar float-left">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="users-profile-data">
                    <h5>Leave group</h5>
                </div>
            </div>
        </div>
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
