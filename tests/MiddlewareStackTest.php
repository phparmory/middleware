<?php

namespace Armory\Middleware\Tests;

use PHPUnit_Framework_TestCase;
use Armory\Middleware\MiddlewareStack;
use Armory\Middleware\Tests\Stubs\CapitalizeMiddleware;

class MiddlewareStackTest extends PHPUnit_Framework_TestCase
{
    public function testRunWithoutMiddleware()
    {
        $stack = new MiddlewareStack;

        $this->assertEquals('test', $stack->pass('test')->run());
    }

    public function testRunWithSingleMiddleware()
    {
        $stack = new MiddlewareStack;

        $this->assertEquals(
            'TEST',
            $stack->pass('test')->through(new CapitalizeMiddleware)->run()
        );
    }
}

