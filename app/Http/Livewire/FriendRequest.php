<?php

namespace App\Http\Livewire;

use App\Chat;
use App\Friend;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FriendRequest extends Component
{
    public $requestName;

    public function sendRequest()
    {
        $this->validate([
            'requestName' => 'required|max:50',
        ]);

        $user1 = User::whereId(Auth::id())->first();
        $user2 = User::whereUsername($this->requestName)->first();

        if ($user2 == null)
        {
            session()->flash('friend_danger', 'User not found!');
        }
        else {
            if ($user1->id == $user2->id)
            {
                return redirect('/dashboard')->with([
                    'dashboard_success' => "You can't send a request to yourself"
                ]);
            }

            $friend = new Friend();
            $friend->user_1_id = $user1->id;
            $friend->user_2_id = $user2->id;
            $friend->request_status = 'pending';
            $friend->save();

            $this->reset('requestName');
            session()->flash('friend_success', 'Request send!');
        }

    }

    public function requestAccepted($id)
    {
//        Select users
        $friendRequest = Friend::whereId($id)->first();
        $authUser = User::whereId(Auth::id())->first();
        $user = User::whereId($friendRequest->user_1_id)->first();

        Friend::whereId($id)->update([
            'request_status' => 'accepted',
        ]);

//        Create new private chat between friends
        $chat = new Chat();
        $chat->type = 'private';
        $chat->save();

//        Attach users to created chat
        $chat->users()->attach($user->id,[
            'chat_id' => $chat->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $chat->users()->attach($authUser->id,[
            'chat_id' => $chat->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function requestDenied($id)
    {
        $request = Friend::whereId($id)->first();
        $request->delete();
    }

    public function render()
    {
        $friendRequests = Friend::where('user_2_id', Auth::id())->where('request_status', 'pending')->get();
        return view('livewire.friend-request', ['friendRequests' => $friendRequests]);
    }
}
