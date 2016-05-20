# Middleware
Simple but extendable middleware

### Example

```php
<?php
use Armory\Middleware\Contracts\MiddlewareInterface;
use Armory\Middleware\MiddlewareStack;

class Capitalize implements MiddlewareInterface
{
    public function handle($passable, $next)
    {
        $passable = strtoupper($passable);
        $next($passable);
        return $passable;
    }
}

class Logger implements MiddlewareInterface
{
    public function handle($passable, $next)
    {
        echo $passable;
        $next($passable);
        return $passable;
    }
}

$stack = new MiddlewareStack;

$output = $stack->pass('Hello World')
    ->through(new Capitalize)
    ->through(new Logger)
    ->run(); // outputs 'Hello World'

echo $output; // outputs 'HELLO WORLD';
```
