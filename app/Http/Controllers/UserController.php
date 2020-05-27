<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Friend;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
//        dd(Auth::id());
        $AuthUser = Auth::id();
        $user = User::where('id', $AuthUser)->first();

        $friendRequests = Friend::where('user_2_id', $user->id)->where('request_status', 'pending')->get();

        $chats = Chat::whereHas('users', function($q) {
            $q->where('user_id', auth()->user()->id);
        })->get();

        $messages = Message::all();

        $data = [
            'user' => $user,
            'friendRequests' => $friendRequests,
            'chats' => $chats,
            'messages' => $messages,
        ];

        return view('profile.dashboard')->with($data);
    }

    public function show()
    {
        return view('profile.show');
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

//        Check if avatar needs to be updated
        if (isset($request->avatar))
        {
            $image = $request->avatar->store('images');
            $request = array_merge($request, ['avatar' => $image]);
        }

    }
}
