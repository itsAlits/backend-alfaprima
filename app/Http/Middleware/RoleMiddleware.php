<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        // Load the role relationship if not already loaded
        if (!$user->relationLoaded('role')) {
            $user->load('role');
        }

        // Check if user has the required role
        if (!$user->role || !in_array($user->role->name, $roles)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Insufficient permissions.',
                'required_roles' => $roles,
                'user_role' => $user->role ? $user->role->name : null
            ], 403);
        }

        return $next($request);
    }
}
