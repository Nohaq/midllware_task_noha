<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilMidlleware
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
        // dd(Auth::user()->id==Post::find($request->route('post'))->user_id);
             
        if ((Auth::user()->roles()->where('role_id', '=', 1)->first())<>null)
        return $next($request);
        elseif(Auth::user()->id==Post::find($request->route('post'))->user_id)
        return $next($request);
        else 
        return  redirect(route('posts.index')) ;
       
        
        
       
    
    }
}
