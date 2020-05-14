<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function store(Request $request)
    {
//        $request->validate([
//            'name' => 'required|max:50',
//        ]);
//
//        $user1 = User::whereId(Auth::id())->first();
//        $user2 = User::whereUsername($request->name)->first();
//
//        if ($user1->id == $user2->id)
//        {
//            return redirect('/dashboard')->with([
//                'dashboard_success' => "You can't send a request to yourself"
//            ]);
//        }
//
//        $friend = new Friend();
//        $friend->user_1_id = $user1->id;
//        $friend->user_2_id = $user2->id;
//        $friend->request_status = 'pending';
//        $friend->save();
//
//        return redirect('/dashboard')->with([
//            'dashboard_success' => 'Friend request successfully sent!'
//        ]);
    }

    public function accept($id)
    {
//        Friend::whereId($id)->update([
//            'request_status' => 'accepted',
//        ]);
//
////        Create new private chat between friends
//        $chat = new Chat();
//        $chat->type = 'private';
//        $chat->save();
//
////        Attach users to created chat
//        $authUser = User::whereId(Auth::id())->first();
//        $acceptedUser = Friend::whereId($id)->first();
//        $user = User::whereId($acceptedUser->user_1_id)->first();
////        dd($user);
//
//        $chat->users()->attach($user->id,[
//            'chat_id' => $chat->id,
//            'created_at' => now(),
//            'updated_at' => now(),
//        ]);
//        $chat->users()->attach($authUser->id,[
//            'chat_id' => $chat->id,
//            'created_at' => now(),
//            'updated_at' => now(),
//        ]);
//
//        return redirect('/dashboard')->with([
//            'dashboard_success' => 'Friend request accepted'
//        ]);
    }

    public function decline($id)
    {
        $request = Friend::whereId($id)->first();
        $request->delete();

        return redirect('/dashboard')->with([
            'dashboard_success' => 'Friend request declined'
        ]);
    }
}
