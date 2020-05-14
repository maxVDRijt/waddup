<?php

namespace App\Http\Livewire;

use App\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MessagePost extends Component
{
    public $message;
    public $chat_id;

    public function render()
    {
        return view('livewire.message-post');
    }

    public function submit()
    {
//        $this->validate([
//            'message' => 'required|max:255',
//            'chat_id' => 'required',
//        ]);
        dd($this);

        $message = new Message();
        $message->user_id = Auth::id();
        $message->chat_id = $this->chat_id;
        $message->message = $this->message;
        $message->save();
        dd($this);
//
        session()->flash('dashboard_success', 'Form submitted');
        $this->reset();
//
//        return redirect('/dashboard');
    }
}
