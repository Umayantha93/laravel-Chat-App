<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;

class PeopleController extends Controller
{
    // REGISTER METHOD
    public function register(Request $request){
        
        //validation
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:people',
            'password' => 'required|confirmed'
        ]);

        // create data
        $people = new People();

        $people->name = $request->name;
        $people->email = $request->email;
        $people->password = bcrypt($request->password);

        // save data
        $people->save();
        return response()->json([
            "status" => 1,
            "message" => "Successfully Inserted"
        ]);

    }
    
    //LOGIN METHOD - POST
    public function login(Request $request){
        $login_data = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        if(!auth()->attempt($login_data)){
            return response()->json([
                "status" => false,
                "message" => "email or password is incorrect"
            ]);
        }

        $token = auth()->user()->createToken("auth_token")->accessToken;

            return response()->json([
                "status" => true,
                "message" => "Logged in Successfully",
                "access_token" => $token
            ]);
    }

    //PROFILE METHOD - GET
    public function profile(){

        $user_data = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "User Data",
            "data" => $user_data
        ]);

    }

    //LOGOUT METHOD - GET
    public function logout(Request $request){
        // get token value
        $token = $request->user()->token();

        // revoke this token value
        $token->revoke();

        return response()->json([
            "status" => true,
            "message" => "Author logged out successfully"
        ]);
    }

    public function listChats(){
        $people = People::where('id', '!=', Auth::id())->get('name');
        $conversation = Conversation::where('id', '=', Auth::id())->get('title');

        $this->data['people'] = $people;
        $this->data['coversation'] = $conversation;

        return $this->data;

    }

}
