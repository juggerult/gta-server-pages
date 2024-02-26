<?php

namespace Tests\Feature;

use App\Models\Promocode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PromocodeTest extends TestCase
{

    public function testCreatePromo($id): void
    {
        $promo = Promocode::create([
            'promocode' => 'TestPromocode',
            'user_id' => $id,
        ]);

        $this->assertEquals(Promocode::class, $promo);
    }
}
