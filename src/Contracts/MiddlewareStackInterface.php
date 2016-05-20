<?php

namespace Armory\Middleware\Contracts;

use Closure;

interface MiddlewareStackInterface
{
    /**
     * Pass something through the middleware
     * @param mixed $passable
     * @return void
     */
    public function pass($passable);

    /**
     * Adds a middleware to the collection
     * @param MiddlwareInterface $middleware
     * @return void
     */
    public function through(MiddlewareInterface $middleware);

    /**
     * Resolves the entire stack
     * @return mixed
     */
    public function run();
}
