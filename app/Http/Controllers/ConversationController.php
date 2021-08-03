<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{

    
    //CREATE CONVERSATION
    public function createConversation(Request $request){

        $validatedData = $request->validate([
            'title' => 'required',
            'owner_id' => 'required',
        ]);

        $con = new Conversation;
        $con->title = $request->title;
        $con->owner_id = $request->owner_id;
        $con->save();

        return response()->json([
            "status" => 1,
            "message" => "sucessfully created"
        ]);
    }

}
