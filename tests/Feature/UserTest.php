<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function testCreateUser(): void
    {
        $user = User::create([
            'login' => 'TestLogin',
            'email' => 'test.email@email',
            'password' => bcrypt('TestPassword'),
        ]);

        $this->assertInstanceOf(User::class, $user);

        $this->assertEquals('TestLogin', $user->login);
        $this->assertEquals('test.email@email', $user->email);

    }

    public function testDeleteUser($id): void
    {
        $user = User::find($id);

        $user->delete();

        $this->assertDeleted($user);
    }
}
