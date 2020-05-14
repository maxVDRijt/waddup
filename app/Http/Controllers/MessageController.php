<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
//    public function store(Request $request, $id)
//    {
//        $request->validate([
//            'message' => 'required|max:255',
//        ]);
//
//        $message = new Message();
//        $message->user_id = Auth::id();
//        $message->chat_id = $id;
//        $message->message = $request->message;
//        $message->save();
//
//        return redirect('/dashboard');
//    }
}
