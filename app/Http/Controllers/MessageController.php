<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        return view("pure.messages.index", [
            'messages' => Message::orderBy('created_at')->paginate(10)
        ]);
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        return $message;
    }


    public function store(Request $request)
    {
        $input = $request->validate([
            'email' => 'required|max:255',
            'nickname' => 'required|max:255',
            'content' => 'required|max:255',
        ]);


        // create
        $message = Message::create([
            'nickname' => $input['nickname'],
            'email' => $input['email'],
            'content' => $input['content']
        ]);


        // update
        // $message = Message::find(1);
        // $message->fill(['content' => $input['content']]);
        // $message->save();


        return view("pure.messages.index", [
            'messages' => Message::all(),
        ]);
    }
}
