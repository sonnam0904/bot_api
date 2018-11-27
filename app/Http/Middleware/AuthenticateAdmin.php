<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class AuthenticateAdmin
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /***
     * AuthenticateAdmin constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user())
        {
            if (in_array($request->user()->id, [1]))
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('admin.admin.index');
            }
        }
        else
        {
            return redirect()->route('admin.admin.index');
        }
    }
}
