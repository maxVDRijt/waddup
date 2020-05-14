@extends('layouts.app')

@section('content')
    <section class="user-dashboard w-100">

        @if(session()->has('dashboard_success'))
            {{ session()->get('dashboard_success') }}
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 people-section">
                    <h1>{{ $user->name }}</h1>
                    <h3>{{ $user->email }}</h3>
                    <div class="all-chats">
                       @livewire('sidebar')
                    </div>
                </div>
                <div class="col-md-8 chat-section p-0">
                    @livewire('messages')
                </div>
                <div class="col-md-2 profile-section">
                    <div class="friend-section">
                        @livewire('friend-request')
                    </div>
                    <a class="btn btn-danger" href="{{ route('auth.logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </section>
@endsection
