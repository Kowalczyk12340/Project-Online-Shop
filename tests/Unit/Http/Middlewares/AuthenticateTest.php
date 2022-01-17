<?php

namespace Tests\Unit\Http\Middleware;

use Mockery as m;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RedirectIfAuthenticated;

class AuthenticateTest extends TestCase {

    public function testIAmLoggedIn()
    {
        // Login as someone
        $user = new User(['name' => 'User']);
        $this->be($user);

        // Call as AJAX request.
        $response = $this->call('get', '/admin');

        $this->assertEquals(404, $response->getStatusCode());
    }

}