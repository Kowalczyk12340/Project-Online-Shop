<?php

namespace Tests\Unit\RelationshipTests;

use App\Models\User;
use Tests\ModelTestCase;

class UserTest extends ModelTestCase
{
    public function test_displaying_user()
    {
        $users = User::all();
        $user = $users->first();
        $this->assertNotEquals(null, $user);
    }

    public function test_displaying_correct_email_for_user()
    {
        $users = User::all();
        $userEmail = $users->first()->email;
        $this->assertEquals('marcin.admin@kowalczyk.com', $userEmail);
    }

    public function test_displaying_correct_value_password_for_user()
    {
        $users = User::all();
        $password = $users->first()->password;
        $this->assertNotEquals(null, $password);
    }
}