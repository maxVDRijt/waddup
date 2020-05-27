<?php

namespace App\Http\Livewire;

use App\Chat;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GroupActions extends Component
{
    public $selectedUsers;

    protected $listeners = [
        'makeAdmin' => 'makeAdmin',
        'removeAdmin' => 'removeAdmin',
        'kickFromGroup' => 'kickFromGroup',
    ];

    public function addUsers($id)
    {
        $chat = Chat::whereId($id)->first();
        foreach ($this->selectedUsers as $user)
        {
            $currentUser = User::whereSlug($user)->first();
            $chat->users()->attach($currentUser->id,[
                'chat_id' => $chat->id,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $message = new Message();
            $message->user_id = 0;
            $message->chat_id = $id;
            $message->message = Auth::user()->name . ' has added ' . $currentUser->username . ' this group chat';
            $message->save();
        }
    }

    public function makeAdmin($user_id)
    {
        $user = User::whereId($user_id)->first();
        $updateRole=$user->chats()->wherePivot('role','=','user')->first()->pivot ;
        $updateRole->role='admin' ;
        $updateRole->save();
    }

    public function removeAdmin($user_id)
    {
        $user = User::whereId($user_id)->first();
        $updateRole=$user->chats()->wherePivot('role','=','admin')->first()->pivot ;
        $updateRole->role='user' ;
        $updateRole->save() ;
    }

    public function kickFromGroup($id)
    {
        $chat = Chat::whereId(36)->first();
        $chat->users()->detach($id);
        $user = User::whereId($id)->first();

        $message = new Message();
        $message->user_id = 0;
        $message->chat_id = $chat->id;
        $message->message = Auth::user()->name . ' has removed ' . $user->username . ' from the group';
        $message->save();
    }

    public function render()
    {
        $id = 36;
        $chat = Chat::whereId($id)->first();
        $users = User::whereDoesntHave('chats',
            function($q) use($id)
            {
                $q->whereIn('chat_id', [$id]);
            }
        )->get();
        return view('livewire.group-add', [
            'users' => $users,
            'chat' => $chat,
            ]);
    }
}
