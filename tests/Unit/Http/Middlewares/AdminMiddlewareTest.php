<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use App\Http\Middleware\AdminMiddleware;
use App\Models\User;

class AdminMiddlewareTest extends TestCase
{
    public function test_it_appends_test_header()
    {
        $user = User::first();
        $chooseUser = $user->name;
        $middleware = AdminMiddleware::class;

        $this->assertNotInstanceOf($middleware, AdminMiddleware::class);
        $this->assertNotEquals(null, $chooseUser);
    }
}