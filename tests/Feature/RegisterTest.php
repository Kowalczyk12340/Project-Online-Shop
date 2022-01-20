<?php

use Illuminate\Support\Facades\Notification;
use App\Notifications\User\EmailVerificationLink;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\Feature\ActionTestCase;

class RegisterTest extends ActionTestCase
{

    public function getRouteName(): string
    {
        return 'register';
    }

    public function test_register_screen_is_rendered()
    {
        $response = $this->get('/register');

        $response->assertOk();
    }

    public function test_register_new_user()
    {
        $response = $this->post('/register', [
            'name' => 'Marcin Kowalczyk',
            'email' => 'marcin.kowalczyk@kowalczyk.com',
            'password' => 'Marcingrafik1#',
            'password_confirmation' => 'Marcingrafik1#',
        ]);

        $response->assertStatus(302);
        $response->assertSeeText('Redirecting to');
    }

    public function test_user_with_valid_data_should_be_registered()
    {
        $this->callRouteAction([
            'name' => 'Marcin Kowalczyk',
            'email'    => 'marcin.kowalczyk@kowalczyk.com',
            'password' => 'Marcingrafik1#',
        ])->assertOk();

        $this->assertDatabaseHas('users', [
            'name' => 'Marcin Kowalczyk',
        ]);
    }
}