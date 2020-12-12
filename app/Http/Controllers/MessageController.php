<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function viewDidLoad()
    {
        return view("messages", [
            'messages' => Message::all(),
            'test' =>  Message::findOrFail(1)->context
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
            'context' => $input['context']
        ]);


        // update
        // $message = Message::find(1);
        // $message->fill(['context' => $input['context']]);
        // $message->save();


        return view("messages", [
            'messages' => Message::all(),
            'test' => $message->context
        ]);
    }
}
