<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAdminAuthenticated
{
    /**
     * Redirect already-logged-in admins away from the login page.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
