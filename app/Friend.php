<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'users', 'id', 'user_id');
    }

    public function user_1()
    {
        return $this->belongsTo(User::class);
    }

    public function user_2()
    {
        return $this->belongsTo(User::class);
    }
}
