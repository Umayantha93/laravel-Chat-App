<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    // ADD PARTICIPANTS
    public function addParticipant(Request $request, $id){
        
        $request->validate([
            "person_id" => "required",
            "conversation_id" => "required",
        ]);

        $participant = new Participant();
        $participant->person_id = $request->person_id;
        $participant->coversation_id = $request->conversation_id;

        $participant->save();

        return response()->json([
            "status" => 1,
            "message" => "Insert Successfully",
        ]);
    }

    //REMOVE PARTICIPANTS
    public function removeParticipant($id){
        
        $participant = Participant::find($id);

        $participant->delete();

        return response()->json([
            "status" => 1,
            "message" => "Delete Successfully",
        ]);

    }
}
