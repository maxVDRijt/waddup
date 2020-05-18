@extends('layouts.app')

@section('content')
    <section class="user-dashboard w-100">
        @if(session()->has('dashboard_success'))
            {{ session()->get('dashboard_success') }}
        @endif

{{--        Create new chat group modal     --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New group chat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @livewire('chats')
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 people-section">
                    <div class="my-info">
                        <img src="{{ $user->avatar }}">
                        <p class="float-right" data-toggle="modal" data-target="#exampleModal">
                            <svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd"/>
                            </svg>
                        </p>
                    </div>
                    <div class="all-chats">
                       @livewire('sidebar')
                    </div>
                    <div class="friend-section">
                        @livewire('friend-request')
                    </div>
                </div>
                <div class="col-md-8 chat-section p-0">
                    @livewire('messages')
                </div>
                <div class="col-md-2 profile-section">
                    <a class="btn btn-danger" href="{{ route('auth.logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </section>
@endsection
