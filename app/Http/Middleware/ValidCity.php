<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;

class ValidCity
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
        $city = $request->city;
        $client = new Client();
        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='. $city .'&region=fr&key=AIzaSyBjExSHAuBYPmeKLtZAoVtnPRt43yA6bpw');
        $body = $res->getBody();
        $status = json_decode($body)->status;

        if ($status == "OK") {
            return $next($request);
        }

        return new RedirectResponse(url('search/city'));
    }
}
