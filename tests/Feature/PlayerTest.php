<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerTest extends TestCase
{

    public function testCreatePlayer(): void
    {
        $player = Player::create([
            'nickname' => 'TestNickname',
            'server' => '2',
            'gender' => 'TestMale',
        ]);

        $this->assertInstanceOf(Player::class, $player);

        $this->assertEquals('TestNickname', $player->nickname);
        $this->assertEquals('2', $player->server);
        $this->assertEquals('TestMale', $player->gender);
    }
}
