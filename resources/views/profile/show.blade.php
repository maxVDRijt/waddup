@extends('layouts.app')

@section('content')
<section class="user-edit">
    <div class="container mt-5">
        <h4>My profile</h4>
        <div class="row">
            <div class="col-md-8">
                <div class="user-edit-data">
                    <form method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        <label for="Username" class="mb-0 mt-2">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ Auth::user()->username }}">
                        @error('username')
                            <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                        @enderror

                        <label for="Name" class="mb-0 mt-2">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                        @error('name')
                            <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                        @enderror

                        <label for="Email" class="mb-0 mt-2">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}">
                        @error('email')
                            <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                        @enderror

                        <label for="Avatar" class="mb-0 mt-2">Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                        @error('avatar')
                            <p class="alert alert-danger form-alert-message">{{ $message }}</p>
                        @enderror

                        <button class="btn btn-success float-right mt-5">Save</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="user-avatar-edit">
                    <img src="{{ Auth::user() ->avatar }}" alt="user avatar">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
