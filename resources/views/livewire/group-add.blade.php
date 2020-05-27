<div>
    <form wire:submit.prevent="addUsers({{$chat->id}})">
        <label for="name" class="mb-0">Select users you want to add:</label>
        <select class="form-control mb-2" multiple data-max-options="10" wire:model="selectedUsers">
            @forelse($users as $user)
                <option value="{{ $user->slug }}">{{ $user->name }}</option>
            @empty
            @endforelse
        </select>
        @error('users')
        <p class="alert alert-danger form-alert-message">{{ $message }}</p>
        @enderror
        <input value=">" type="submit" class="send-message">
    </form>
</div>
