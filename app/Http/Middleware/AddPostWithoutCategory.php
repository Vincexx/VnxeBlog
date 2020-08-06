<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class AddPostWithoutCategory
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

        if(Category::all()->count() <= 0) {
            return response()->json([
                'message' => 'You cannot add post without category.'
            ]);
        }

        return $next($request);
    }
}
