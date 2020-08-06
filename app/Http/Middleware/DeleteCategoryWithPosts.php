<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class DeleteCategoryWithPosts
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

        if($request->category->posts->count() > 0) {

            return response()->json([
                'message' => 'You cannot delete this category because there are posts associated with this category.'
            ]);

        }

        return $next($request);
    }
}
