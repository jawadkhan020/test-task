<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
class adminApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apitoken = $request->header('apitoken');
      
        if($apitoken){
            $user = User::where('api_token',$apitoken)->first();
           
            if($user){
                $request->merge([
                    'user_id' => $user->id
                ]);
                
                    return $next($request);
               
            }
            
        }
        return response()->json([
            'success' => false,
            'message' => "Unauthorized Access"
        ]);
    }
}
