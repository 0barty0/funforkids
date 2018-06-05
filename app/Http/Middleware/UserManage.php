<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class UserManage
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
        $event = \App\Event::find($request->event);

        if ($request->user()->id ==  $event->user_id) {
            return $next($request);
        }

        return new RedirectResponse(url('event'));
    }
}
