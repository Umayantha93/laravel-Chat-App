<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use APP\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(Conversation::where('owner_id', '=', Auth::id()) ){
            if(Coversation::where('id', '=', $request->conversation_id)){

                return $next($request);

            }
                
        }
        return response()->json('Person Cannot Access This Conversation');
        
    }
}
