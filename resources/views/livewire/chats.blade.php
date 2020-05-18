<div>
    <form wire:submit.prevent="createChat">
        <label for="name" class="mb-0">New group title:</label>
        <input type="text" max="20" class="form-control mb-2" wire:model="title">
        @error('title')
        <p class="alert alert-danger form-alert-message">{{ $message }}</p>
        @enderror

        <label for="name" class="mb-0">Select users you want to add:</label>
        <select class="form-control mb-2" multiple data-max-options="10" wire:model="users">
            @forelse($chats as $chat)
                <option value="{{ $chat->them()->slug }}">{{ $chat->them()->name }}</option>
            @empty
            @endforelse
        </select>
        @error('users')
        <p class="alert alert-danger form-alert-message">{{ $message }}</p>
        @enderror
        <input value=">" type="submit" class="send-message">
    </form>
</div>
