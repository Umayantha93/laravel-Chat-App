<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // DISPLAY MESSAGE
    public function displayMessages(){
        $message = Message::all();
        return $message->bodytext;
    }
    // MESSAGE SEND
    public function sendMessage($request){
        $request->validate([
            "person_id" => "required",
            "conversation_id" => "required",
            "bodytext" => "required"
        ]);
       
        $message = new Message();
        $message->person_id = $request->auth()->user()->id;
        $message->conversation_id = $request->conversation_id;
        $message->bodytext = $request->bodytext;

        $message->save();

        return response()->json([
            "status" => 1,
            "message" => "Insert Successfully",
        ]);
    }

    // MESSAGE DELETE 
    public function deleteMessage($id){

        $message = Message::find($id);

        $message->delete();

        return response()->json([
            "status" => 1,
            "message" => "Delete Successfully",
        ]);

    }
}
