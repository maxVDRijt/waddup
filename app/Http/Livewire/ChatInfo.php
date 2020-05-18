<?php

namespace App\Http\Livewire;

use App\Chat;
use Livewire\Component;

class ChatInfo extends Component
{
    //    Main variables
    public $currentChat;
    public $messages;

    protected $listeners = ['chatInfo' => 'chatInfo'];

    public function chatInfo($id)
    {
        $this->currentChat = Chat::whereId($id)->first();
    }

    public function render()
    {
        if($this->currentChat == null)
        {
            $this->currentChat = Chat::whereHas('users', function($q) {
                $q->where('user_id', auth()->user()->id);
            })->orderby('updated_at', 'DESC')->first();
        }

        return view('livewire.chat-info', [
            'chat' => $this->currentChat,
        ]);
    }
}
