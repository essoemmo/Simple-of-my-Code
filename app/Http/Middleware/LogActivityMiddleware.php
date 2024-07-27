<?php

namespace App\Http\Middleware;

use App\Logging\ActivityLogging;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogActivityMiddleware
{
    protected ActivityLogging $logger;

    public function __construct(ActivityLogging $logger)
    {
        $this->logger = $logger;
    }
    public function handle(Request $request, Closure $next): Response
    {
        $this->logger->log('request', $request->method() . ' ' . $request->path());
        return $next($request);
    }
}
