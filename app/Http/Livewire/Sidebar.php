<?php

namespace App\Http\Livewire;

use App\Chat;
use Livewire\Component;

class Sidebar extends Component
{
    public function selectChat($id)
    {
        $this->emit('selectChat', $id);
        $this->emit('chatInfo', $id);
    }

    public function render()
    {
        $chats = Chat::whereHas('users', function($q) {
            $q->where('user_id', auth()->user()->id);
        })->orderby('updated_at', 'DESC')->get();
        return view('livewire.sidebar', ['chats' => $chats]);
    }
}
