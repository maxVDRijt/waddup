<?php

namespace App\Http\Livewire;

use App\Chat;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chats extends Component
{
    public $title;
    public $users;

    public function createChat()
    {
//        $this->validate([
//            'title' => 'required|max:20',
//            'users.*' => 'required|array|between:2,10',
//        ]);

        $chat = new Chat();
        $chat->type = 'group';
        $chat->title = $this->title;
        $chat->save();

//        Attach everyone at the new chat
        $chat->users()->attach(Auth::id(),[
            'chat_id' => $chat->id,
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        foreach ($this->users as $user)
        {
            $currentUser = User::whereSlug($user)->first();
            $chat->users()->attach($currentUser->id,[
                'chat_id' => $chat->id,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function render()
    {
        $chats = Chat::whereHas('users', function($q) {
            $q->where('user_id', auth()->user()->id);
        })->whereType('private')->get();
        return view('livewire.chats', ['chats' => $chats]);
    }
}
