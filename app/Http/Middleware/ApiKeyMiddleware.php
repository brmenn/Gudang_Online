<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-Key');

        if (! $apiKey) {
            return response()->json(['message' => 'API key is missing'], 401);
        }

        $key = ApiKey::where('key', $apiKey)
            ->where('is_active', true)
            ->first();

        if (! $key) {
            return response()->json(['message' => 'Invalid or inactive API key'], 401);
        }

        if ($key->expires_at && $key->expires_at->isPast()) {
            return response()->json(['message' => 'API key has expired'], 401);
        }

        $key->update(['last_used_at' => now()]);

        return $next($request);
    }
}
