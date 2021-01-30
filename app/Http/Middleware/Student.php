<?php

namespace App\Http\Middleware;

use App\Studentinfo;
use Closure;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('studentloginstatus') == 1){
            return $next($request);
        }else{
            return redirect('student/login');
        }
    }
}
