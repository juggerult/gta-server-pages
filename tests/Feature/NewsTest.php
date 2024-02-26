<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    public function testCreateNews(): void
    {
        $news = News::create([
            'title' => 'TestTitle',
            'news' => 'TestNews',
        ]);

        $this->assertInstanceOf(News::class, $news);

        $this->assertEquals('TestTitle', $news->title);
        $this->assertEquals('TestNews', $news->news);

    }
}
