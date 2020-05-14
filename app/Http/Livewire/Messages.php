<?php

namespace App\Http\Livewire;

use App\Chat;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Messages extends Component
{
//    Main variables
    public $currentChat;
    public $messages;

//    Message post variables
    public $text;

    protected $listeners = ['selectChat' => 'selectChat'];

    public function selectChat($id)
    {
        $this->messages = Message::where('chat_id', $id)->get();
        $this->currentChat = Chat::whereId($id)->first();
    }

    public function sendMessage($id)
    {
        $this->validate([
            'text' => 'required|max:255',
        ]);

        $message = new Message();
        $message->user_id = Auth::id();
        $message->chat_id = $id;
        $message->message = $this->text;
        $message->save();

        Chat::whereId($id)->update([
            'updated_at' => now(),
        ]);

        $this->reset('text');

        $this->messages = Message::where('chat_id', $id)->get();
        $this->currentChat = Chat::whereId($id)->first();
        return view('livewire.message', [
            'messages' => $this->messages,
            'chat' => $this->currentChat,
        ]);
    }

    public function render()
    {
        if ($this->currentChat == null)
        {
            $this->currentChat = Chat::whereHas('users', function($q) {
                $q->where('user_id', auth()->user()->id);
            })->orderby('updated_at', 'DESC')->first();
            if ($this->currentChat == null)
            {
                $this->messages = '';
                $this->currentChat = '';
            }
            else {
                $this->messages = Message::where('chat_id', $this->currentChat->id)->get();
            }
        }
        return view('livewire.message', [
            'messages' => $this->messages,
            'chat' => $this->currentChat,
        ]);
    }
}
