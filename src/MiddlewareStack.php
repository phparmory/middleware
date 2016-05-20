<?php

namespace Armory\Middleware;

use Armory\Middleware\Contracts\MiddlewareInterface;
use Armory\Middleware\Contracts\MiddlewareStackInterface;
use Closure;
use SplStack;

class MiddlewareStack implements MiddlewareStackInterface
{
    /**
     * A stack of middleware
     * @var array
     */
    protected $stack = [];

    /**
     * The object to pass through the middleware
     * @var mixed
     */
    protected $passable;

    /**
     * Pass something through the middleware
     * @param mixed $passable
     * @return MiddlewareStack
     */
    public function pass($passable) : MiddlewareStack
    {
        $this->passable = $passable;

        return $this;
    }

    /**
     * Adds a middleware to the collection
     * @param MiddlewareInterface $middleware
     * @return void
     */
    public function through(MiddlewareInterface $middleware) : MiddlewareStack
    {
        $this->stack[] = $middleware;

        return $this;
    }

    /**
     * Resolves the entire stack
     * @return mixed
     */
    public function run()
    {
        // If there's no middleware on the stack then just return the passable
        if (empty($this->stack)) {
            return $this->passable;
        }

        // Run the middleware stack and return it's value
        return call_user_func(array_reduce(
            $this->stack,
            $this->layer(),
            $this->core()
        ), $this->passable);
    }

    /**
     * Create a middleware stack layer
     * @return Closure
     */
    protected function layer()
    {
        return function($next, $middleware)
        {
            return function($passable) use ($next, $middleware)
            {
                return $middleware->handle($passable, $next);
            };
        };
    }

    /**
     * Create the middleware stack core
     * @return Closure
     */
    protected function core()
    {
        return function($passable)
        {
            return $passable;
        };
    }
}
