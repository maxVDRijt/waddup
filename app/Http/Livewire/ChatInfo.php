<?php

namespace App\Http\Livewire;

use App\Chat;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatInfo extends Component
{
    //    Main variables
    public $currentChat;
    public $currentAdmins;
    public $messages;

    protected $listeners = [
        'chatInfo' => 'chatInfo',
        'chooseAdmin' => 'chooseAdmin',
        'clearAdmin' => 'clearAdmin',
        'kickUser' => 'kickUser',
    ];

    public function chatInfo($id)
    {
        $this->currentChat = Chat::whereId($id)->first();
    }

    public function chooseAdmin($id)
    {
        $this->emit('makeAdmin', $id);
    }

    public function clearAdmin($id)
    {
        $this->emit('removeAdmin', $id);
    }

    public function kickUser($id)
    {
        $this->emit('kickFromGroup', $id);
    }

    public function leaveFromGroup($chatId)
    {
        $chat = Chat::whereId($chatId)->first();
        $countAdmins = 0;
        foreach ($chat->users as $user)
        {
            if ($user->setChatRoleAttribute() == 'true')
            {
                $countAdmins = $countAdmins + 1;
            }
            if ($user->id == Auth::id() && $user->setChatRoleAttribute() == 'false')
            {
                $countAdmins = 2;
            }
        }

        if ($countAdmins > 1)
        {
            $chat->users()->detach(Auth::id());

            $message = new Message();
            $message->user_id = 0;
            $message->chat_id = $chat->id;
            $message->message = Auth::user()->name . ' left the group';
            $message->save();

            $chats = Chat::whereHas('users', function($q) {
                $q->where('user_id', auth()->user()->id);
            })->orderby('updated_at', 'DESC')->get();
        }
        else {
            session()->flash('leave_danger', 'Please set someone as group admin before leaving');
        }
    }

    public function render()
    {
        if($this->currentChat == null)
        {
            $this->currentChat = Chat::whereHas('users', function($q) {
                $q->where('user_id', auth()->user()->id);
            })->orderby('updated_at', 'DESC')->first();
        }

        $this->currentAdmins = User::whereHas('chats', function($q) {
            $q->where('role', 'admin');
        })->get();

        return view('livewire.chat-info', [
            'chat' => $this->currentChat,
            'admins' => $this->currentAdmins,
        ]);
    }
}
