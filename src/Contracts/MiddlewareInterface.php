<?php

namespace Armory\Middleware\Contracts;

interface MiddlewareInterface
{
    /**
     * Handle the incoming request
     * @param mixed $passable
     * @param Closure $next
     * @return mixed
     */
    public function handle($passable, $next);
}
