<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function viewDidLoad()
    {
        return view("messages", [
            'messages' => Message::all()->sortByDesc('created_at'),
        ]);
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        return $message;
    }


    public function onPost(Request $request)
    {
        $input = $request->all();

        // create
        $message = Message::create([
            'user_name' => $input['user_name'],
            'content' => $input['content']
        ]);


        // update
        // $message = Message::find(1);
        // $message->fill(['content' => $input['content']]);
        // $message->save();


        return view("messages", [
            'messages' => Message::all(),
        ]);
    }
}
