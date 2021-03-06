<?php

namespace Dingo\Api\Tests\Http\RateLimit\Throttle;

use Mockery;
use PHPUnit_Framework_TestCase;
use Illuminate\Container\Container;
use Dingo\Api\Http\RateLimit\Throttle\Authenticated;

class AuthenticatedTest extends PHPUnit_Framework_TestCase
{
    public function testThrottleMatchesCorrectly()
    {
        $auth = Mockery::mock('Dingo\Api\Auth\Auth')->shouldReceive('check')->once()->andReturn(true)->getMock();
        $container = new Container;
        $container['api.auth'] = $auth;

        $this->assertTrue((new Authenticated)->match($container));
    }
}
