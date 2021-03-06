<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function me()
    {
       return $this->users()->where('users.id', auth()->id())->first();
    }

    public function them()
    {
        if ($this->type == 'private')
        {
            return  $this->users()->where('users.id', '!=', auth()->id())->first();
        }
        else {
            return  $this->users()->where('users.id', '!=', auth()->id())->get();
        }
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
