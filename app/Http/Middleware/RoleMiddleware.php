<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;


class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        Log::info('Authenticated User', [
            'id' => $request->user()?->id,
            'email' => $request->user()?->email,
            'role' => $request->user()?->role,
            'url' => $request->url(),
            'method' => $request->method(),
        ]);
        $user = $request->user();
        if (!$user || !in_array($user->role, $roles)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
