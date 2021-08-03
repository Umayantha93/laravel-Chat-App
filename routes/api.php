<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PeopleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [PeopleController::class, "register"]);
Route::post('login', [PeopleController::class, "login"]);

Route::group(["middleware" => ["auth:api"]], function(){

    Route::get("profile", [PeopleController::class, "profile"]);
    Route::post("logout", [PeopleController::class, "logout"]);
    Route::get("list-chats", [PeopleController::class, "listChats"]);

    Route::get("display-messages", [MessageController::class, "displayMessages"]);
    Route::post("send-message", [MessageController::class, "sendMessage"]);
    Route::post("delete-message/{id}", [MessageController::class, "deleteMessage"]);

    Route::post("create-conversation", [ConversationController::class, "createConversation"]);

    Route::get("add-participant", [ParticipantController::class, "addParticipant"])->middleware(['AccessPermission']);;
    Route::get("remove-participant", [ParticipantController::class, "removeParticipant"])->middleware(['AccessPermission']);

});
