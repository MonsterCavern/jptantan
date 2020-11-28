<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    //
    function viewdidload()
    {
        return view("messages", [
            'test' =>  Message::findOrFail(1)->context
        ]);
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        return $message;
    }

}
