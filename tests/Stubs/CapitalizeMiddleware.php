<?php

namespace Armory\Middleware\Tests\Stubs;

use Armory\Middleware\Contracts\MiddlewareInterface;

class CapitalizeMiddleware implements MiddlewareInterface
{
    public function handle($passable, $next)
    {
        $passable = strtoupper($passable);
        $passable = $next($passable);
        return $passable;
    }
}
