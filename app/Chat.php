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
        $users = $this->users()->get();
        foreach ($users as $user)
        {
            if ($user->id == Auth::user()->id)
            {
                return $user;
            }
        }
    }

    public function them()
    {
        $users = $this->users()->get();
        foreach ($users as $user)
        {
            if ($user->id != Auth::user()->id)
            {
                return $user;
            }
        }
    }
}
