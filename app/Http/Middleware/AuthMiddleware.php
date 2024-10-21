<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token=$request->cookie('token');
        if($token==null){
            return redirect('/login');
        }else{
            $token=JWTToken::VerifyToken($token);
            if($token=='unauthorized'){
                return redirect('/login');
            }else{
                $request->headers->set('email',$token->email);
                $request->headers->set('id',$token->id);
                $request->headers->set('role',$token->role);
                return $next($request);
            }
        }
    }
}
