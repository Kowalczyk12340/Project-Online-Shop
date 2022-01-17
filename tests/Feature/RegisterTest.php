<?php

use Illuminate\Support\Facades\Notification;
use App\Notifications\User\EmailVerificationLink;
use App\Models\User;
use Tests\Feature\ActionTestCase;

class RegisterTest extends ActionTestCase
{

    public function getRouteName(): string
    {
        return 'register';
    }

    function test_user_with_valid_data_should_be_registered()
    {
        Notification::fake();

        $this->callRouteAction([
            'name' => 'Marcin Kowalczyk',
            'email'    => 'marcin.kowalczyk@kowalczyk.com',
            'password' => 'Marcingrafik1#',
        ])->assertOk();

        $this->assertDatabaseHas('users', [
            'name' => 'Marcin Kowalczyk',
        ]);

        $user = User::first();

        Notification::assertNotSentTo($user, EmailVerificationLink::class);
    }
}