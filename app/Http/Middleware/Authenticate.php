<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Check if the request expects JSON, return null (used for APIs)
        if ($request->expectsJson()) {
            return null;
        }

        // Check the guard or request URI to decide the redirection
        if ($request->is('admin/*')) {
            return route('admin.login'); // Admin login route
        }

        if ($request->is('favorites/*') || $request->is('favorite/*')) {
            // Redirect to customer login for favorite routes
            return route('customer.login'); // Replace with your customer login route
        }

        // Default redirect for general web users
        return route('customer.login');
    }
}
