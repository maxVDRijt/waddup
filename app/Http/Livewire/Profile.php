<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $requestUsername;
    public $requestName;
    public $requestEmail;
    public $requestAvatar;

    public function updateProfile()
    {
        $this->validate([
            'requestUsername' => 'required|max:50',
            'requestName' => 'required|max:50',
            'requestEmail' => 'required|max:50',
            'requestAvatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        dd($this);
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
